<?php

namespace App\Http\Controllers;

use App\Helpers\OldLiquidacion;
use App\Models\FacturaPredial;
use App\Models\Predio;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;
use Milon\Barcode\Facades\DNS1DFacade;

class FacturaPredialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('FacturaPredials/Index', [
            'facturaPredials' => FacturaPredial::withTrashed()->orderByDesc('id')->get()->map(function ($facturaPredial) {
                return [
                    'id' => $facturaPredial->id,
                    'created_at' => $facturaPredial->created_at,
                    'codigo_catastro' => $facturaPredial->data['codigo_catastro'],
                    'total' => $facturaPredial->data['total'],
                    'orden' => $facturaPredial->data['orden'],
                    'pague_hasta' => $facturaPredial->data['pague_hasta'],
                    'factura_pagada' => $facturaPredial->data['factura_pagada'],
                    'state' => !$facturaPredial->trashed()
                ];
            })
        ]);
    }

    public function search(Request $request)
    {
        return inertia('FacturaPredials/Search', [
            'predios' => Predio::search($request->input('searchQuery'), false)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return inertia('FacturaPredials/Create', [
            'predio' => Predio::show($request->input('predio'), false)
        ]);
    }

    private function generateBarcode($id, $total_liquidacion, $pague_hasta)
    {
        $codigo_barras = DB::table('codigosbarras')
            ->select('codigo', 'codini')
            ->where('estado', 'S')
            ->where('tipo', '01')
            ->first();

        $barcode = chr(241) . $codigo_barras->codini . $codigo_barras->codigo . '802001' .
            sprintf('%07d', $id) . '111005001' .
            chr(241) . '3900' . sprintf('%010d', $total_liquidacion) .
            chr(241) . '96' . (new Carbon($pague_hasta))->format('Ymd');

        $barcode_human = '(' . $codigo_barras->codini . ')' . $codigo_barras->codigo . '(8020)01' .
            sprintf('%07d', $id) . '111005001' .
            '(3900)' . sprintf('%010d', $total_liquidacion) .
            '(96)' . (new Carbon($pague_hasta))->format('Ymd');

        return [
            'img' => DNS1DFacade::getBarcodePNG($barcode, 'C128'),
            'human' => $barcode_human
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->input('data');

        $data['pague_hasta'] = FacturaPredial::getPagueHasta(collect($data['liquidacion']['vigencias']));

        $old_liquidacion_id = OldLiquidacion::save($data['liquidacion'], auth()->user()?->name ?? '');

        $facturaPredial = FacturaPredial::create([
            'id' => $old_liquidacion_id,
            'ip' => $request->ip(),
            'data' => array_merge($data, [
                'barcode' => $this->generateBarcode(
                    $old_liquidacion_id,
                    $data['liquidacion']['total_liquidacion'],
                    $data['pague_hasta']
                )
            ])
        ]);

        return response()->json(['id' => $facturaPredial->id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FacturaPredial $facturaPredial)
    {
        if ($request->has('toggle')) {
            if (!$facturaPredial->data['factura_pagada']) {
                $facturaPredial->delete();
            }

            return;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FacturaPredial $facturaPredial)
    {
        if (($facturaPredial->data['private'] ?? false) && !Auth::check()) {
            throw new UnauthorizedException();
        }

        return Pdf::loadView('pdf.factura_predial', [
            'facturaPredial' => (object) [
                'id' => $facturaPredial->id,
                'ip' => $facturaPredial->ip,
                'data' => $facturaPredial->data,
                'created_at' => $facturaPredial->created_at,
                'state' => !$facturaPredial->trashed()
            ]
        ])->stream($facturaPredial->id . '_' . now()->format('YmdHis') . '_factura-de-pago.pdf');
    }
}
