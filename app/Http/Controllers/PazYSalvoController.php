<?php

namespace App\Http\Controllers;

use App\Models\PazYSalvo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class PazYSalvoController extends Controller
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
    public function store(Request $request)
    {
        $data = $request->input('data');

        $pazYSalvo = PazYSalvo::create([
            'ip' => $request->ip(),
            'data' => $data
        ]);

        return response()->json(['id' => $pazYSalvo->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PazYSalvo $pazYSalvo)
    {
        if (($pazYSalvo->data['private'] ?? false) && !Auth::check()) {
            throw new UnauthorizedException();
        }

        return Pdf::loadView('pdf.factura_predial', [
            'pazYSalvo' => (object) [
                'id' => $pazYSalvo->id,
                'ip' => $pazYSalvo->ip,
                'data' => $pazYSalvo->data,
                'created_at' => $pazYSalvo->created_at,
                'state' => !$pazYSalvo->trashed()
            ]
        ])->stream($pazYSalvo->id . '_' . now()->format('YmdHis') . '_paz-y-salvo.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PazYSalvo $pazYSalvo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PazYSalvo $pazYSalvo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PazYSalvo $pazYSalvo)
    {
        //
    }
}
