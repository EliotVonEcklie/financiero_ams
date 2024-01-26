<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInteresRequest;
use App\Http\Requests\UpdateInteresRequest;
use App\Models\Interes;

class InteresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Parametros/Interes/Index', [
            'interes' => Interes::withTrashed()
                ->orderByDesc('vigencia')->orderByDesc('mes')
                ->get()->map(function ($interes) {
                    return [
                        'id' => $interes->id,
                        'vigencia' => $interes->vigencia,
                        'mes' => $interes->mes,
                        'moratorio' => $interes->moratorio,
                        'corriente' => $interes->corriente,
                        'state' => !$interes->trashed()
                    ];
                })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Parametros/Interes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInteresRequest $request)
    {
        $interes = Interes::create($request->validated());
        $interes->user_id = auth()->id();
        $interes->save();

        return to_route('interes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Interes $intere)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interes $intere)
    {
        return inertia('Parametros/Interes/Edit', [
            'interes' => [
                'id' => $intere->id,
                'vigencia' => $intere->vigencia,
                'mes' => $intere->mes,
                'moratorio' => $intere->moratorio,
                'corriente' => $intere->corriente,
                'state' => !$intere->trashed()
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInteresRequest $request, Interes $intere)
    {
        if ($request->has('toggle')) {
            if ($intere->trashed()) {
                $intere->restore();
            } else {
                $intere->delete();
            }

            return;
        }

        $intere->update($request->validated());

        return to_route('interes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interes $intere)
    {
        $intere->delete();

        return to_route('interes.index');
    }
}
