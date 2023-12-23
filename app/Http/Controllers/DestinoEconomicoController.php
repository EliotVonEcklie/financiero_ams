<?php

namespace App\Http\Controllers;

use App\Models\DestinoEconomico;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinoEconomicoRequest;
use App\Http\Requests\UpdateDestinoEconomicoRequest;
use App\Models\CodigoDestinoEconomico;
use RuntimeException;

class DestinoEconomicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('DestinoEconomicos/Index', [
            'destinoEconomicos' => DestinoEconomico::withTrashed()->get()->map(function ($destino_economico) {
                return [
                    'id' => $destino_economico->id,
                    'nombre' => $destino_economico->nombre,
                    'codigo_destino_economicos' => $destino_economico->codigo_destino_economicos,
                    'trashed' => $destino_economico->trashed()
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('DestinoEconomicos/Create', [
            'codigoDestinoEconomicos' => CodigoDestinoEconomico::where('destino_economico_id', null)->get()->map(function ($codigo_destino_economico) {
                return [
                    'id' => $codigo_destino_economico->id,
                    'codigo' => $codigo_destino_economico->codigo
                ];
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDestinoEconomicoRequest $request)
    {
        // Store the destino economico...
        $destino_economico = DestinoEconomico::create($request->safe()->except('codigo_destino_economicos'));

        foreach ($request->safe()['codigo_destino_economicos'] as $codigo_destino_economico) {
            $codigo_destino_economico = CodigoDestinoEconomico::find($codigo_destino_economico);
            $codigo_destino_economico->destino_economico_id = $destino_economico->id;
            $codigo_destino_economico->save();
        }

        return to_route('destino_economicos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DestinoEconomico $destinoEconomico)
    {
        return inertia('DestinoEconomicos/Show', [
            'destinoEconomico' => [
                'id' => $destinoEconomico->id,
                'nombre' => $destinoEconomico->nombre,
                'codigo_destino_economicos' => $destinoEconomico->codigo_destino_economicos,
                'trashed' => $destinoEconomico->trashed()
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DestinoEconomico $destinoEconomico)
    {
        return inertia('DestinoEconomicos/Edit', [
            'destinoEconomico' => [
                'id' => $destinoEconomico->id,
                'nombre' => $destinoEconomico->nombre,
                'codigo_destino_economicos' => $destinoEconomico->codigo_destino_economicos,
                'trashed' => $destinoEconomico->trashed()
            ],
            'codigoDestinoEconomicos' => CodigoDestinoEconomico::where('destino_economico_id', null)->get()->map(function ($codigo_destino_economico) {
                return [
                    'id' => $codigo_destino_economico->id,
                    'codigo' => $codigo_destino_economico->codigo
                ];
            })
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDestinoEconomicoRequest $request, DestinoEconomico $destinoEconomico)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestinoEconomico $destinoEconomico)
    {
        //
    }
}
