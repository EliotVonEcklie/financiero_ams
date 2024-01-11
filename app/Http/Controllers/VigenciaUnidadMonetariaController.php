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
        return inertia('Parametros/VigenciaUnidadMonetarias/Index', [
            'vigenciaUnidadMonetarias' => VigenciaUnidadMonetaria::withTrashed()->where('valor', '<>', 1)->get()->map(function ($vigenciaUnidadMonetaria) {
                return [
                    'id' => $vigenciaUnidadMonetaria->id,
                    'vigencia' => $vigenciaUnidadMonetaria->vigencia,
                    'unidadMonetaria' => [
                        'id' => $vigenciaUnidadMonetaria->unidadMonetaria->id,
                        'tipo' => $vigenciaUnidadMonetaria->unidadMonetaria->tipo
                    ],
                    'valor' => $vigenciaUnidadMonetaria->valor,
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
        return inertia('Parametros/VigenciaUnidadMonetarias/Create', [
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
        return inertia('Parametros/VigenciaUnidadMonetarias/Edit', [
            'vigenciaUnidadMonetaria' => [
                'id' => $vigenciaUnidadMonetaria->id,
                'vigencia' => $vigenciaUnidadMonetaria->vigencia,
                'unidad_monetaria_id' => $vigenciaUnidadMonetaria->unidadMonetaria->id,
                'valor' => $vigenciaUnidadMonetaria->valor
            ],
            'unidadMonetarias' => UnidadMonetaria::all()->map(function ($unidadMonetaria) {
                return [
                    'id' => $unidadMonetaria->id,
                    'tipo' => $unidadMonetaria->tipo
                ];
            })
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVigenciaUnidadMonetariaRequest $request, VigenciaUnidadMonetaria $vigenciaUnidadMonetaria)
    {
        if ($request->safe()->has('toggle')) {
            if ($vigenciaUnidadMonetaria->trashed()) {
                $vigenciaUnidadMonetaria->restore();
            } else {
                $vigenciaUnidadMonetaria->delete();
            }

            return;
        }

        // Update the unidad monetaria...
        $vigenciaUnidadMonetaria->update($request->validated());

        return to_route('vigencia_unidad_monetarias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VigenciaUnidadMonetaria $vigenciaUnidadMonetaria)
    {
        $vigenciaUnidadMonetaria->forceDelete();

        return to_route('vigencia_unidad_monetarias.index');
    }
}
