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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInteresRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Interes $interes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interes $interes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInteresRequest $request, Interes $interes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interes $interes)
    {
        //
    }
}
