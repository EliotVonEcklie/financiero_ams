<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePredioEstratoRequest;
use App\Http\Requests\UpdatePredioEstratoRequest;
use App\Models\PredioEstrato;

class PredioEstratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('PredioEstratos/Index', [
            'predioEstratos' => PredioEstrato::withTrashed()->get()->map(function ($predioEstrato) {
                return [
                    'id' => $predioEstrato->id,
                    'estrato' => $predioEstrato->estrato,
                    'state' => !$predioEstrato->trashed(),
                    'user' => [
                        'id' => isset($predioEstrato->user) ? $predioEstrato->user->id : null,
                        'name' =>  isset($predioEstrato->user) ? $predioEstrato->user->name : ''
                    ]
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('PredioEstratos/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePredioEstratoRequest $request)
    {
        // Store the predio estrato...
        PredioEstrato::create($request->validated());

        return to_route('predio_estratos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PredioEstrato $predioEstrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PredioEstrato $predioEstrato)
    {
        return inertia('PredioEstratos/Edit', [
            'predioEstrato' => [
                'id' => $predioEstrato->id,
                'estrato' => $predioEstrato->estrato,
                'state' => !$predioEstrato->trashed(),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePredioEstratoRequest $request, PredioEstrato $predioEstrato)
    {
        if ($request->safe()->has('toggle')) {
            if ($predioEstrato->trashed()) {
                $predioEstrato->restore();
            } else {
                $predioEstrato->delete();
            }

            return;
        }

        // Update the predio estrato...
        $predioEstrato->update($request->validated());

        return to_route('predio_estratos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PredioEstrato $predioEstrato)
    {
        $predioEstrato->forceDelete();

        return to_route('predio_estratos.index');
    }
}
