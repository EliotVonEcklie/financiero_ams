<?php

namespace App\Http\Controllers;

use App\Models\Prescripcion;
use App\Models\Predio;
use Illuminate\Http\Request;

use App\Jobs\ImportPrescripciones;

use Illuminate\Support\Facades\DB;


class PrescripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Prescripciones/Index', [
            'prescripciones' => Prescripcion::withTrashed()->orderBy('id', 'desc')->get()->map(function ($prescripcion){

                return[
                    'id' => $prescripcion->id,
                    'created_at' => $prescripcion->created_at,
                    'codigo_catastro' => $prescripcion->data['codigo_catastro'],
                    'contribuyente' => $prescripcion->data['documento'] . ' - ' . $prescripcion->data['nombre_propietario'],
                    'canDelete' => now() < $prescripcion->data['hasta'],
                    'resolucion' => $prescripcion->data['resolucion'],
                    'state' => ! $prescripcion->trashed()
                ];

            })
        ]);
    }

    public function search(Request $request)
    {
        return inertia('Prescripciones/Search', [
            'predios' => Predio::search($request->input('searchQuery'), false)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $predio = Predio::find($request->input('predio'));
        $predio_show = Predio::show($predio, false);

        //$vigMaxVigencia = max($predio_show['liquidacion']['vigencias']);

        return inertia('Prescripciones/Create', [
            'predio' => $predio_show,
            'propietarios' => $predio->propietarios()
                ->select(['orden', 'id', 'documento', 'nombre_propietario'])
                ->distinct()
                ->where('orden', $predio_show['orden'])
                /* ->whereYear('created_at', $vigMaxVigencia) */
                ->orderByDesc('created_at')
                ->get()->map(function ($propietario) {
                    return [
                        'orden' => $propietario->orden,
                        'id' => $propietario->id,
                        'documento' => $propietario->documento,
                        'nombre_propietario' => $propietario->nombre_propietario
                    ];
                })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->input('data');
        return response()->json(['data' => $data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescripcion $prescripcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescripcion $prescripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescripcion $prescripcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescripcion $prescripcion)
    {
        //
    }

    public function importInfo(){

        //dd('Importando informacion...');

        //MiJob::dispatch()->onConnection('sync');
        ImportPrescripciones::dispatch()->onConnection('sync');

        return "El job ha sido despachado correctamente.";

    }
}
