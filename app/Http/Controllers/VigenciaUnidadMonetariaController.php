<?php

namespace App\Http\Controllers;

use App\Models\VigenciaUnidadMonetaria;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVigenciaUnidadMonetariaRequest;
use App\Http\Requests\UpdateVigenciaUnidadMonetariaRequest;
use App\Models\UnidadMonetaria;

class VigenciaUnidadMonetariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('VigenciaUnidadMonetarias/Index', [
            'vigenciaUnidadMonetarias' => VigenciaUnidadMonetaria::withTrashed()->get()->map(function ($vigenciaUnidadMonetaria) {
                return [
                    'id' => $vigenciaUnidadMonetaria->id,
                    'vigencia' => $vigenciaUnidadMonetaria->vigencia,
                    'unidadMonetaria' => $vigenciaUnidadMonetaria->unidadMonetaria,
                    'predioTipo' => $vigenciaUnidadMonetaria->predioTipo,
                    'state' => !$vigenciaUnidadMonetaria->trashed()

                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('VigenciaUnidadMonetarias/Create', [
            'unidadMonetarias' => UnidadMonetaria::all()->map(function ($unidadMonetaria) {
                return [
                    'id' => $unidadMonetaria->id,
                    'tipo' => $unidadMonetaria->tipo
                ];
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVigenciaUnidadMonetariaRequest $request)
    {
        // Store the unidad monetaria...
        VigenciaUnidadMonetaria::create($request->validated());

        return to_route('vigencia_unidad_monetarias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(VigenciaUnidadMonetaria $vigenciaUnidadMonetaria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VigenciaUnidadMonetaria $vigenciaUnidadMonetaria)
    {
        return inertia('UnidadMonetarias/Edit', [
            'unidadMonetaria' => [
                'id' => $vigenciaUnidadMonetaria->id,
                'vigencia' => $vigenciaUnidadMonetaria->vigencia,
                'unidadMonetaria' => $vigenciaUnidadMonetaria->unidadMonetaria,
                'predioTipo' => $vigenciaUnidadMonetaria->predioTipo
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVigenciaUnidadMonetariaRequest $request, VigenciaUnidadMonetaria $vigenciaUnidadMonetaria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VigenciaUnidadMonetaria $vigenciaUnidadMonetaria)
    {
        //
    }
}
