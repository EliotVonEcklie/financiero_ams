<?php

namespace App\Http\Controllers;

use App\Models\EstadoCuenta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EstadoCuentaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $estadoCuenta = EstadoCuenta::create([
            'ip' => $request->ip(),
            'data' => $request->input('data')
        ]);

        return response()->json(['id' => $estadoCuenta->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(EstadoCuenta $estadoCuenta)
    {
        return Pdf::loadView('pdf.estado_cuenta', [
            'estadoCuenta' => $estadoCuenta
        ])->stream($estadoCuenta->id . '_' . now()->format('YmdHis') . '_estado-cuenta.pdf');
    }
}
