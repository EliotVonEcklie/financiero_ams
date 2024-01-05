<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEstratificacionRequest;
use App\Http\Requests\UpdateEstratificacionRequest;
use App\Models\Estratificacion;
use App\Models\DestinoEconomico;
use App\Models\PredioTipo;
use App\Models\PredioEstrato;
use App\Models\RangoAvaluo;

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
                        'nombre' => $estratificacion->predio_tipo->nombre
                    ],
                    'destinoEconomico' => [
                        'id' => $estratificacion->destino_economico->id,
                        'nombre' => $estratificacion->destino_economico->nombre
                    ],
                    'tarifa' => $estratificacion->format_tarifa(),
                    'tasa' => $estratificacion->tasa,
                    'state' => !$estratificacion->trashed()
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
                    'nombre' => $predioTipo->nombre
                ];
            }),
            'destinoEconomicos' => DestinoEconomico::all()->map(function ($destinoEconomico) {
                return [
                    'id' => $destinoEconomico->id,
                    'nombre' => $destinoEconomico->nombre
                ];
            }),
            'rangoAvaluos' => RangoAvaluo::all()->map(function ($rangoAvaluo) {
                return [
                    'id' => $rangoAvaluo->id,
                    'desde' => $rangoAvaluo->desde,
                    'hasta' => $rangoAvaluo->hasta,
                    'unidadMonetaria' => [
                        'id' => $rangoAvaluo->unidad_monetaria->id,
                        'tipo' => $rangoAvaluo->unidad_monetaria->tipo
                    ]
                ];
            }),
            'predioEstratos' => PredioEstrato::all()->map(function ($predioEstrato) {
                return [
                    'id' => $predioEstrato->id,
                    'estrato' => $predioEstrato->estrato
                ];
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstratificacionRequest $request)
    {
        $validated = $request->validated();

        Estratificacion::create([
            'vigencia' => $validated['vigencia'],
            'predio_tipo_id' => $validated['predio_tipo_id'],
            'destino_economico_id' => $validated['destino_economico_id'],
            'tarifa_id' => $validated['tarifa']['id'],
            'tarifa_type' => $validated['tarifa']['type'],
            'tasa' => $validated['tasa']
        ]);

        return to_route('estratificacions.index');
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
                'predio_tipo_id' => $estratificacion->predio_tipo->id,
                'destino_economico_id' => $estratificacion->destino_economico->id,
                'tarifa' => [
                    'id' => $estratificacion->tarifa_id,
                    'type' => $estratificacion->tarifa_type
                ],
                'tasa' => $estratificacion->tasa,
                'status' => !$estratificacion->trashed()
            ],
            'predioTipos' => PredioTipo::all()->map(function ($predioTipo) {
                return [
                    'id' => $predioTipo->id,
                    'nombre' => $predioTipo->nombre
                ];
            }),
            'destinoEconomicos' => DestinoEconomico::all()->map(function ($destinoEconomico) {
                return [
                    'id' => $destinoEconomico->id,
                    'nombre' => $destinoEconomico->nombre
                ];
            }),
            'rangoAvaluos' => RangoAvaluo::all()->map(function ($rangoAvaluo) {
                return [
                    'id' => $rangoAvaluo->id,
                    'desde' => $rangoAvaluo->desde,
                    'hasta' => $rangoAvaluo->hasta,
                    'unidadMonetaria' => [
                        'id' => $rangoAvaluo->unidad_monetaria->id,
                        'tipo' => $rangoAvaluo->unidad_monetaria->tipo
                    ]
                ];
            }),
            'predioEstratos' => PredioEstrato::all()->map(function ($predioEstrato) {
                return [
                    'id' => $predioEstrato->id,
                    'estrato' => $predioEstrato->estrato
                ];
            })
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstratificacionRequest $request, Estratificacion $estratificacion)
    {
        if ($request->safe()->has('toggle')) {
            if ($estratificacion->trashed()) {
                $estratificacion->restore();
            } else {
                $estratificacion->delete();
            }

            return;
        }

        $validated = $request->validated();

        $estratificacion->update([
            'vigencia' => $validated['vigencia'],
            'predio_tipo_id' => $validated['predio_tipo_id'],
            'destino_economico_id' => $validated['destino_economico_id'],
            'tarifa_id' => $validated['tarifa']['id'],
            'tarifa_type' => $validated['tarifa']['type'],
            'tasa' => $validated['tasa']
        ]);

        return to_route('estratificacions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estratificacion $estratificacion)
    {
        $estratificacion->forceDelete();

        return to_route('estratificacions.index');
    }
}
