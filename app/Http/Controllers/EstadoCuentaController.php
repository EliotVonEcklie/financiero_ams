<?php

namespace App\Http\Controllers;

use App\Models\EstadoCuenta;
use App\Models\Predio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class EstadoCuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return inertia('EstadoCuentas/Index', [
            'predios' => Predio::search($request->input('searchQuery'), false)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return inertia('EstadoCuentas/Create', [
            'predio' => Predio::show($request->input('predio'), false)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $estadoCuenta = EstadoCuenta::create([
            'ip' => $request->ip(),
            'data' => $request->input('data')
        ]);

        return response()->json(['id' => $estadoCuenta->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(EstadoCuenta $estadoCuenta)
    {
        if (($estadoCuenta->data['private'] ?? false) && !Auth::check()) {
            return tenant() ? to_route('login') : throw new UnauthorizedException();
        }

        return Pdf::loadView('pdf.estado_cuenta', [
            'estadoCuenta' => $estadoCuenta
        ])->stream($estadoCuenta->id . '_' . now()->format('YmdHis') . '_estado-cuenta.pdf');
    }
}
