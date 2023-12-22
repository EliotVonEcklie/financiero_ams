<?php

namespace App\Http\Controllers;

use App\Models\CodigoDestinoEconomico;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCodigoDestinoEconomicoRequest;
use App\Http\Requests\UpdateCodigoDestinoEconomicoRequest;

class CodigoDestinoEconomicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCodigoDestinoEconomicoRequest $request)
    {
        $errors = $request->errors();

        if ($errors->any()) {
            return response()->json($errors->all());
        }

        // The incoming request is valid...

        // Retrieve the validated input data...
        $validated = $request->validated();

        // Store the destino economico...
        $predio = CodigoDestinoEconomico::create($validated);
        $predio->save();

        return response()->json([
            'success' => 'Saved destino economico successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CodigoDestinoEconomico $codigoDestinoEconomico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CodigoDestinoEconomico $codigoDestinoEconomico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCodigoDestinoEconomicoRequest $request, CodigoDestinoEconomico $codigoDestinoEconomico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CodigoDestinoEconomico $codigoDestinoEconomico)
    {
        //
    }
}
