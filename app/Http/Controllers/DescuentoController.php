<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDescuentoRequest;
use App\Http\Requests\UpdateDescuentoRequest;
use App\Models\Descuento;

class DescuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Parametros/Descuentos/Index', [
            'descuentos' => Descuento::withTrashed()
                ->orderBy('es_nacional')->orderByDesc('hasta')
                ->get()->map(function ($descuento) {
                    return [
                        'id' => $descuento->id,
                        'es_nacional' => $descuento->es_nacional,
                        'hasta' => $descuento->hasta,
                        'porcentaje' => $descuento->porcentaje,
                        'state' => !$descuento->trashed()
                    ];
                })
        ]);
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
    public function store(StoreDescuentoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Descuento $descuento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Descuento $descuento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDescuentoRequest $request, Descuento $descuento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Descuento $descuento)
    {
        //
    }
}
