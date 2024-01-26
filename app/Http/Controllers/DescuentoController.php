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
        return inertia('Parametros/Descuentos/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDescuentoRequest $request)
    {
        $descuento = Descuento::create($request->validated());
        $descuento->user_id = auth()->id();
        $descuento->save();

        return to_route('descuentos.index');
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
        return inertia('Parametros/Descuentos/Edit', [
            'descuento' => [
                'id' => $descuento->id,
                'es_nacional' => $descuento->es_nacional,
                'hasta' => $descuento->hasta,
                'porcentaje' => $descuento->porcentaje
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDescuentoRequest $request, Descuento $descuento)
    {
        if ($request->has('toggle')) {
            if ($descuento->trashed()) {
                $descuento->restore();
            } else {
                $descuento->delete();
            }

            return;
        }

        $descuento->update($request->validated());

        return to_route('descuentos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Descuento $descuento)
    {
        $descuento->delete();

        return to_route('descuentos.index');
    }
}
