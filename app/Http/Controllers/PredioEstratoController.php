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
            'predioEstratos' => PredioEstrato::withTrashed()->map(function ($predioEstrato) {
                return [
                    'id' => $predioEstrato->id,
                    'estrato' => $predioEstrato->estrato,
                    'state' => !$predioEstrato->trashed(),
                    'user' => [
                        'name' =>  $predioEstrato->user->name
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePredioEstratoRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePredioEstratoRequest $request, PredioEstrato $predioEstrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PredioEstrato $predioEstrato)
    {
        //
    }
}
