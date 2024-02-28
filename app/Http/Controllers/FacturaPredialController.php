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
                $total_liquidacion = array_reduce(array_values(array_filter($facturaPredial->data['liquidacion']['vigencias'], function($v) {
                    return $v['isSelected'] ?? $v['selected'] ?? false;
                })), function($a, $v) {
                    return $a + $v['total_liquidacion'];
                }, 0);

                return [
                    'id' => $facturaPredial->id,
                    'created_at' => $facturaPredial->created_at,
                    'codigo_catastro' => $facturaPredial->data['codigo_catastro'],
                    'contribuyente' => $facturaPredial->data['documento'] . ' - ' . $facturaPredial->data['nombre_propietario'],
                    'total_liquidacion' => $total_liquidacion,
                    'pague_hasta' => $facturaPredial->data['pague_hasta'],
                    'factura_pagada' => $facturaPredial->data['factura_pagada'],
                    'state' => ! $facturaPredial->trashed()
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
                'barcode' => FacturaPredial::generateBarcode(
                    $old_liquidacion_id,
                    $data['liquidacion']['total_liquidacion'],
                    $data['pague_hasta']
                )
            ]),
            'user_id' => auth()->id()
        ]);

        return response()->json(['id' => $facturaPredial->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(FacturaPredial $facturaPredial)
    {
        if (($facturaPredial->data['private'] ?? false) && ! Auth::check()) {
            throw new UnauthorizedException();
        }

        return Pdf::loadView('pdf.factura_predial', [
            'facturaPredial' => (object) [
                'id' => $facturaPredial->id,
                'ip' => $facturaPredial->ip,
                'data' => $facturaPredial->data,
                'created_at' => $facturaPredial->created_at,
                'state' => ! $facturaPredial->trashed()
            ]
        ])->stream($facturaPredial->id . '_' . now()->format('YmdHis') . '_factura-de-pago.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FacturaPredial $facturaPredial)
    {
        if (! ($facturaPredial->data['factura_pagada'] || $facturaPredial->trashed())) {
            $facturaPredial->delete();
        }

        return back();
    }
}
