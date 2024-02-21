<?php

namespace App\Http\Controllers;

use App\Models\PazYSalvo;
use App\Models\Predio;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;

class PazYSalvoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('PazYSalvos/Index', [
            'pazYSalvos' => PazYSalvo::withTrashed()->orderByDesc('id')->get()->map(function ($pazYSalvo) {
                return [
                    'id' => $pazYSalvo->id,
                    'created_at' => $pazYSalvo->created_at,
                    'codigo_catastro' => $pazYSalvo->data['codigo_catastro'],
                    'contribuyente' => $pazYSalvo->data['documento'] . ' - ' . $pazYSalvo->data['nombre_propietario'],
                    'hasta' => $pazYSalvo->data['hasta'],
                    'tesorecibocaja_id' => $pazYSalvo->data['tesorecibocaja_id'],
                    'canDelete' => now() < $pazYSalvo->data['hasta'],
                    'state' => ! $pazYSalvo->trashed()
                ];
            })
        ]);
    }

    /**
     * Display a search listing of predios.
     */
    public function search(Request $request)
    {
        return inertia('PazYSalvos/Search', [
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

        return inertia('PazYSalvos/Create', [
            'predio' => $predio_show,
            'propietarios' => $predio->propietarios()
                ->whereNot('orden', $predio_show['orden'])
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
        if ($request->data['tesorecibocaja_id'] != 0) {
            if (! DB::table('tesoreciboscaja')->whereNot('estado', 'N')->where('id_recibos', $request->data['tesorecibocaja_id'])->exists()) {
                return response()->json(['error' => 'El recibo de caja no existe o se encuentra anulado.']);
            } else if (PazYSalvo::where('data->tesorecibocaja_id', $request->data['tesorecibocaja_id'])->exists()) {
                return response()->json(['error' => 'El recibo de caja ya está asociado a un paz y salvo.']);
            }
        }

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

        $firma = DB::table('firmaspdf_det')
            ->where('estado', 'S')
            ->where('idfirmas', 8)
            ->orderBy('orden')
            ->first(['funcionario', 'titulo']);

        return Pdf::loadView('pdf.paz_y_salvo', [
            'pazYSalvo' => (object) [
                'id' => $pazYSalvo->id,
                'ip' => $pazYSalvo->ip,
                'data' => array_merge($pazYSalvo->data, ['firma' => $firma]),
                'user' => User::find($pazYSalvo->user_id),
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
