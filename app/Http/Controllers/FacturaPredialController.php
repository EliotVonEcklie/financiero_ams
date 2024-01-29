<?php

namespace App\Http\Controllers;

use App\Models\FacturaPredial;
use App\Models\Predio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'facturaPredials' => FacturaPredial::withTrashed()->get()->map(function ($facturaPredial) {
                return [
                    'id' => $facturaPredial->id,
                    'created_at' => $facturaPredial->created_at,
                    'codigo_catastro' => $facturaPredial->data['codigo_catastro'],
                    'total' => $facturaPredial->data['total'],
                    'orden' => $facturaPredial->data['orden'],
                    'pague_hasta' => $facturaPredial->data['pague_hasta'],
                    'pagado' => $facturaPredial->data['factura_pagada'],
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->input('data');

        $facturaPredial = FacturaPredial::create([
            'ip' => $request->ip(),
            'data' => array_merge($data, [
                'barcode' => DNS1DFacade::getBarcodePNG('4445645656' /* $data['barcode_id'] */, 'C39')
            ])
        ]);

        $facturaPredial->updatePagueHasta();

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
                'ip' => $facturaPredial,
                'data' => $facturaPredial->data,
                'created_at' => $facturaPredial->created_at,
                'state' => !$facturaPredial->trashed()
            ]
        ])->stream($facturaPredial->id . '_' . now()->format('YmdHis') . '_factura-de-pago.pdf');
    }
}
