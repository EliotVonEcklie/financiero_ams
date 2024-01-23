<?php

namespace App\Http\Controllers;

use App\Models\LiquidacionPredial;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LiquidacionPredialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function showPdf(LiquidacionPredial $liquidacionPredial)
    {
        $data = ['title' => 'domPDF in Laravel 10'];
        $pdf = PDF::loadView('pdf.liquidacion_predial', $data);
        return $pdf->stream('liquidacion_predial.pdf');
    }
    public function show(){

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LiquidacionPredial $estadoCuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LiquidacionPredial $estadoCuenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LiquidacionPredial $estadoCuenta)
    {
        //
    }
}
