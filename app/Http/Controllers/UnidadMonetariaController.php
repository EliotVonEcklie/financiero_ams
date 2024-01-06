<?php

namespace App\Http\Controllers;

use App\Models\UnidadMonetaria;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnidadMonetariaRequest;
use App\Http\Requests\UpdateUnidadMonetariaRequest;

class UnidadMonetariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Parametros/UnidadMonetarias/Index', [
            'unidadMonetarias' => UnidadMonetaria::withTrashed()->get()->map(function ($unidadMonetaria) {
                return [
                    'id' => $unidadMonetaria->id,
                    'tipo' => $unidadMonetaria->tipo,
                    'state' => !$unidadMonetaria->trashed()
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Parametros/UnidadMonetarias/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnidadMonetariaRequest $request)
    {
        // Store the unidad monetaria...
        UnidadMonetaria::create($request->validated());

        return to_route('unidad_monetarias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(UnidadMonetaria $unidadMonetaria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnidadMonetaria $unidadMonetaria)
    {
        return inertia('Parametros/UnidadMonetarias/Edit', [
            'unidadMonetaria' => [
                'id' => $unidadMonetaria->id,
                'tipo' => $unidadMonetaria->tipo
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnidadMonetariaRequest $request, UnidadMonetaria $unidadMonetaria)
    {
        if ($request->safe()->has('toggle')) {
            if ($unidadMonetaria->trashed()) {
                $unidadMonetaria->restore();
            } else {
                $unidadMonetaria->delete();
            }

            return;
        }

        // Update the unidad monetaria...
        $unidadMonetaria->update($request->validated());

        return to_route('unidad_monetarias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnidadMonetaria $unidadMonetaria)
    {
        $unidadMonetaria->forceDelete();

        return to_route('unidad_monetarias.index');
    }
}
