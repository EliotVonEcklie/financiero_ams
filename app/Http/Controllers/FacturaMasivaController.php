<?php

namespace App\Http\Controllers;

use App\Models\FacturaMasiva;
use Illuminate\Http\Request;

class FacturaMasivaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('FacturaMasiva/Index', [
            'facturaMasivas' => FacturaMasiva::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('FacturaMasiva/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FacturaMasiva $facturaMasiva)
    {
        return inertia('FacturaMasivas/Show', [
            'facturaMasiva' => $facturaMasiva
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FacturaMasiva $facturaMasiva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FacturaMasiva $facturaMasiva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FacturaMasiva $facturaMasiva)
    {
        //
    }
}
