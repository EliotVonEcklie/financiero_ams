<?php

namespace App\Http\Controllers;

use App\Models\PredioTipo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePredioTipoRequest;
use App\Http\Requests\UpdatePredioTipoRequest;

class PredioTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('PredioTipos/Index', [
            'predioTipos' => PredioTipo::withTrashed()->get()->map(function ($predioTipo) {
                return [
                    'id' => $predioTipo->id,
                    'tipo' => $predioTipo->tipo,
                    'state' => !$predioTipo->trashed()
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('PredioTipos/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePredioTipoRequest $request)
    {
        // Store the unidad monetaria...
        PredioTipo::create($request->validated());

        return to_route('predio_tipos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PredioTipo $predioTipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PredioTipo $predioTipo)
    {
        return inertia('PredioTipos/Edit', [
            'unidadMonetaria' => [
                'id' => $predioTipo->id,
                'tipo' => $predioTipo->tipo
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePredioTipoRequest $request, PredioTipo $predioTipo)
    {
        if ($request->safe()->has('toggle')) {
            if ($predioTipo->trashed()) {
                $predioTipo->restore();
            } else {
                $predioTipo->delete();
            }

            return;
        }

        // Update the unidad monetaria...
        $predioTipo->update($request->validated());

        return to_route('predio_tipos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PredioTipo $predioTipo)
    {
        $predioTipo->forceDelete();

        return to_route('predio_tipos.index');
    }
}
