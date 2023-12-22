<?php

namespace App\Http\Controllers;

use App\Models\DestinoEconomico;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinoEconomicoRequest;
use App\Http\Requests\UpdateDestinoEconomicoRequest;
use App\Models\CodigoDestinoEconomico;

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
     * Display a listing of the resource.
     */
    public function indexApi()
    {
        return response()->json(DestinoEconomico::all());
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
        $errors = $request->errors();

        if ($errors->any()) {
            return response()->json($errors->all());
        }

        // The incoming request is valid...

        // Retrieve the validated input data...
        $validated = $request->validated();

        // Store the destino economico...
        $predio = DestinoEconomico::create($validated);
        $predio->save();

        return response()->json([
            'success' => 'Saved destino economico successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DestinoEconomico $destinoEconomico)
    {
        return response()->json($destinoEconomico);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DestinoEconomico $destinoEconomico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDestinoEconomicoRequest $request, DestinoEconomico $destinoEconomico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestinoEconomico $destinoEconomico)
    {
        //
    }
}
