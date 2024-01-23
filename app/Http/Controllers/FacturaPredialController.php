<?php

namespace App\Http\Controllers;

use App\Models\FacturaPredial;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Milon\Barcode\Facades\DNS1DFacade;

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

        $data = $facturaPredial->data;
        $data['barcode'] = DNS1DFacade::getBarcodePNG('4445645656', 'C39');
        $facturaPredial->data = $data;
        $facturaPredial->save();

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
