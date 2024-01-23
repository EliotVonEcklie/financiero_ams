<?php

namespace App\Http\Controllers;

use App\Models\FacturaPredial;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FacturaPredialController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $facturaPredial = FacturaPredial::create([
            'ip' => $request->ip(),
            'data' => $request->input('data')
        ]);

        return response()->json(['id' => $facturaPredial->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(FacturaPredial $facturaPredial) {
        return Pdf::loadView('pdf.factura_predial', [
            'facturaPredial' => $facturaPredial
        ])->stream($facturaPredial->id . '_' . now()->format('YmdHis') . '_factura-de-pago.pdf');
    }
}
