<?php

namespace App\Http\Controllers;

use App\Models\DestinoEconomico;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinoEconomicoRequest;
use App\Http\Requests\UpdateDestinoEconomicoRequest;

class DestinoEconomicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(DestinoEconomico::all());
    }

    /**
     * Display a listing of the resource. Admin.
     */
    public function indexAdmin()
    {
        return view('admin.destino_economicos.index')->with('destino_economicos', DestinoEconomico::all());
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
