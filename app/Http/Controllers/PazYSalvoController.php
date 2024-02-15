<?php

namespace App\Http\Controllers;

use App\Models\PazYSalvo;
use App\Models\Predio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class PazYSalvoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return inertia('PazYSalvos/Index', [
            'predios' => Predio::search($request->input('searchQuery'), false),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $predio = Predio::find($request->input('predio'));
        $predio_show = Predio::show($predio, false);

        return inertia('PazYSalvos/Create', [
            'predio' => $predio_show,
            'propietarios' => $predio->propietarios()
                ->whereNot('orden', $predio_show['orden'])
                ->get()->map(function ($propietario) {
                    return [
                        'id' => $propietario->id,
                        'documento' => $propietario->documento,
                        'nombre_propietario' => $propietario->nombre_propietario
                    ];
                }),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pazYSalvo = PazYSalvo::create([
            'ip' => $request->ip(),
            'data' => array_merge($request->input('data'), ['hasta' => now()->endOfYear()->toISOString(true)]),
            'user_id' => Auth::id()
        ]);

        return response()->json(['id' => $pazYSalvo->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PazYSalvo $pazYSalvo)
    {
        if (($pazYSalvo->data['private'] ?? false) && ! Auth::check()) {
            throw new UnauthorizedException();
        }

        return Pdf::loadView('pdf.paz_y_salvo', [
            'pazYSalvo' => (object) [
                'id' => $pazYSalvo->id,
                'ip' => $pazYSalvo->ip,
                'data' => $pazYSalvo->data,
                'created_at' => $pazYSalvo->created_at
            ]
        ])->stream($pazYSalvo->id . '_' . now()->format('YmdHis') . '_paz-y-salvo.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PazYSalvo $pazYSalvo)
    {
        if (! $pazYSalvo->trashed()) {
            $pazYSalvo->delete();
        }

        return back();
    }
}
