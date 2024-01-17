<?php

namespace App\Http\Controllers;

use App\Models\EstadoCuenta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EstadoCuentaController extends Controller
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $estadoCuenta = EstadoCuenta::create([
            'fecha' => now(),
            'ip' => $request->ip(),
            'data' => $request->input('data')
        ]);

        return $this->show($estadoCuenta);
    }

    /**
     * Display the specified resource.
     */
    public function show(EstadoCuenta $estadoCuenta)
    {
        return Pdf::loadView('pdf.estado_cuenta', [
            'fecha' => $estadoCuenta->fecha,
            'ip' => $estadoCuenta->ip,
            'data' => $estadoCuenta->data
        ])->stream($estadoCuenta->id . '_' . now()->format('Y-m-d-H:M:S') . '_estado-cuenta.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EstadoCuenta $estadoCuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EstadoCuenta $estadoCuenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstadoCuenta $estadoCuenta)
    {
        //
    }
}
