<?php

namespace App\Http\Controllers;

use App\Models\HistorialPredio;
use App\Models\Predio;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHistorialPredioRequest;
use App\Http\Requests\UpdateHistorialPredioRequest;

class HistorialPredioController extends Controller
{
    /**
     * Display the latest historial predio for a predio
     */
    public function latest(Predio $predio)
    {
        return response()->json($predio->latest_historial_predio());
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Predio $predio)
    {
        return response()->json($predio->historial_predios);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexAdmin(Predio $predio)
    {
        return view('admin.predios.historial_predios.index')->with('historial_predios', HistorialPredio::where('predio_id', $predio->id)->orderBy('fecha', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHistorialPredioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Predio $predio, HistorialPredio $historial_predio)
    {
        return response()->json($historial_predio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHistorialPredioRequest $request, HistorialPredio $historialPredio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistorialPredio $historialPredio)
    {
        //
    }
}
