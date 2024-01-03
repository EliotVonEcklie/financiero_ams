<?php

namespace App\Http\Controllers;

use App\Models\Estratificacion;
use App\Models\DestinoEconomico;
use App\Models\PredioTipo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEstratificacionRequest;
use App\Http\Requests\UpdateEstratificacionRequest;

class EstratificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Estratificaciones/Index', [
            'estratificaciones' => Estratificacion::withTrashed()->get()->map(function ($estratificacion) {
                return [
                    'id' => $estratificacion->id,
                    'vigencia' => $estratificacion->vigencia,
                    'predioTipo' => [
                        'id' => $estratificacion->predio_tipo->id,
                        'tipo' => $estratificacion->predio_tipo->tipo
                    ],
                    'destinoEconomico' => [
                        'id' => $estratificacion->destino_economico->id,
                        'nombre' => $estratificacion->destino_economico->nombre
                    ],
                    'tarifa' => '',
                    'tasa' => $estratificacion->tasa,
                    'status' => !$estratificacion->trashed()
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Estratificaciones/Create', [
            'predioTipos' => PredioTipo::all()->map(function ($predioTipo) {
                return [
                    'id' => $predioTipo->id,
                    'tipo' => $predioTipo->tipo
                ];
            }),
            'destinosEconomicos' => DestinoEconomico::all()->map(function ($destinoEconomico) {
                return [
                    'id' => $destinoEconomico->id,
                    'nombre' => $destinoEconomico->nombre
                ];
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstratificacionRequest $request)
    {
        Estratificacion::create($request->validated());

        return to_route('estratificaciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estratificacion $estratificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estratificacion $estratificacion)
    {
        return inertia('Estratificaciones/Edit', [
            'estratificacion' => [
                'id' => $estratificacion->id,
                'vigencia' => $estratificacion->vigencia,
                'predioTipo' => [
                    'id' => $estratificacion->predio_tipo->id,
                    'tipo' => $estratificacion->predio_tipo->tipo
                ],
                'destinoEconomico' => [
                    'id' => $estratificacion->destino_economico->id,
                    'nombre' => $estratificacion->destino_economico->nombre
                ],
                'tasa' => $estratificacion->tasa,
                'status' => !$estratificacion->trashed()
            ],
            'predioTipos' => PredioTipo::all()->map(function ($predioTipo) {
                return [
                    'id' => $predioTipo->id,
                    'tipo' => $predioTipo->tipo
                ];
            }),
            'destinoEconomicos' => DestinoEconomico::all()->map(function ($destinoEconomico) {
                return [
                    'id' => $destinoEconomico->id,
                    'nombre' => $destinoEconomico->nombre
                ];
            })
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstratificacionRequest $request, Estratificacion $estratificacion)
    {
        $estratificacion->update($request->validated());

        return to_route('estratificaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estratificacion $estratificacion)
    {
        $estratificacion->forceDelete();

        return to_route('estratificaciones.index');
    }
}
