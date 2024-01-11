<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstatutoRequest;
use App\Http\Requests\UpdateEstatutoRequest;
use App\Models\Estatuto;

class EstatutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Estatutos/Index', [
            'estatutos' => Estatuto::withTrashed()->get()->map(function ($estatuto) {
                return [
                    'id' => $estatuto->id,
                    'nombre' => $estatuto->nombre,
                    'vigencia_desde' => $estatuto->vigencia_desde,
                    'vigencia_hasta' => $estatuto->vigencia_hasta,
                    'norma_predial' => $estatuto->norma_predial,
                    'bomberil' => $estatuto->bomberil,
                    'bomberil_predial' => $estatuto->bomberil_predial,
                    'bomberil_tarifa' => $estatuto->bomberil_tarifa,
                    'bomberil_tasa' => $estatuto->bomberil_tasa,
                    'ambiental' => $estatuto->ambiental,
                    'ambiental_predial' => $estatuto->ambiental_predial,
                    'ambiental_tarifa' => $estatuto->ambiental_tarifa,
                    'ambiental_tasa' => $estatuto->ambiental_tasa,
                    'alumbrado' => $estatuto->alumbrado,
                    'alumbrado_rural' => $estatuto->alumbrado_rural,
                    'alumbrado_urbano' => $estatuto->alumbrado_urbano,
                    'alumbrado_tarifa' => $estatuto->alumbrado_tarifa,
                    'alumbrado_tasa' => $estatuto->alumbrado_tasa,
                    'recibo_caja' => $estatuto->recibo_caja,
                    'state' => !$estatuto->trashed()
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Estatutos/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstatutoRequest $request)
    {
        Estatuto::create($request->validated());

        return to_route('estatutos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estatuto $estatuto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estatuto $estatuto)
    {
        return inertia('Estatutos/Edit', [
            'estatuto' => $estatuto
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstatutoRequest $request, Estatuto $estatuto)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estatuto $estatuto)
    {
        $estatuto->forceDelete();

        return to_route('estatutos.index');
    }
}
