<?php

namespace App\Http\Controllers;

use App\Models\RangoAvaluo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRangoAvaluoRequest;
use App\Http\Requests\UpdateRangoAvaluoRequest;
use App\Models\UnidadMonetaria;

class RangoAvaluoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Tasificar/RangoAvaluos/Index', [
            'rangoAvaluos' => RangoAvaluo::withTrashed()->get()->map(function ($rangoAvaluo) {
                return [
                    'id' => $rangoAvaluo->id,
                    'desde' => $rangoAvaluo->desde,
                    'hasta' => $rangoAvaluo->hasta,
                    'unidad_monetaria' => [
                        'id' => $rangoAvaluo->unidad_monetaria->id,
                        'nombre' => $rangoAvaluo->unidad_monetaria->nombre
                    ],
                    'state' => !$rangoAvaluo->trashed()
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Tasificar/RangoAvaluos/Create', [
            'unidadMonetarias' => UnidadMonetaria::all()->map(function ($unidadMonetaria) {
                return [
                    'id' => $unidadMonetaria->id,
                    'nombre' => $unidadMonetaria->nombre
                ];
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRangoAvaluoRequest $request)
    {
        // Store the rango avaluo...
        RangoAvaluo::create($request->validated());

        return to_route('rango_avaluos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(RangoAvaluo $rangoAvaluo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RangoAvaluo $rangoAvaluo)
    {
        return inertia('Tasificar/RangoAvaluos/Edit', [
            'rangoAvaluo' => [
                'id' => $rangoAvaluo->id,
                'desde' => $rangoAvaluo->desde,
                'hasta' => $rangoAvaluo->hasta,
                'unidad_monetaria_id' => $rangoAvaluo->unidad_monetaria->id,
                'state' => !$rangoAvaluo->trashed()
            ],
            'unidadMonetarias' => UnidadMonetaria::all()->map(function ($unidadMonetaria) {
                return [
                    'id' => $unidadMonetaria->id,
                    'nombre' => $unidadMonetaria->nombre
                ];
            })
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRangoAvaluoRequest $request, RangoAvaluo $rangoAvaluo)
    {
        if ($request->safe()->has('toggle')) {
            if ($rangoAvaluo->trashed()) {
                $rangoAvaluo->restore();
            } else {
                $rangoAvaluo->delete();
            }

            return;
        }

        // Update the rango avaluo...
        $rangoAvaluo->update($request->validated());

        return to_route('rango_avaluos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RangoAvaluo $rangoAvaluo)
    {
        $rangoAvaluo->forceDelete();

        return to_route('rango_avaluos.index');
    }
}
