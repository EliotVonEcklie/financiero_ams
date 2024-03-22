<?php

namespace App\Http\Controllers;

use App\Models\FacturaMasiva;
use App\Models\Predio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FacturaMasivaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('FacturaMasivas/Index', [
            'facturaMasivas' => FacturaMasiva::all()->map(fn ($facturaMasiva) => [
                'id' => $facturaMasiva->id,
                'min_deuda' => $facturaMasiva->min_deuda,
                'last_resolucion' => $facturaMasiva->last_resolucion,
                'processing' => $facturaMasiva->processing,
                'created_at' => $facturaMasiva->created_at,
                'state' => ! $facturaMasiva->trashed()
            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('FacturaMasivas/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FacturaMasiva $facturaMasiva)
    {
        return inertia('FacturaMasivas/Show', [
            'facturaMasiva' => $facturaMasiva,
            'resolucions' => function () use ($facturaMasiva) {
                if (file_exists($facturaMasiva->path . 'consulta.csv')) {
                    $csv = fopen($facturaMasiva->path . 'consulta.csv', 'r');
                    fgetcsv($csv);

                    $data = [];
                    $last_resolucion = null;

                    while (($row = fgetcsv($csv)) !== false) {
                        if ($row[1] !== $last_resolucion) {
                            $last_resolucion = $row[1];

                            $predio = Predio::find($row[0]);

                            array_push($data, [
                                'id' => $row[1],
                                'codigo_catastro' => $predio->codigo_catastro,
                                'documento' => $predio->main_propietario()->documento,
                                'nombre_propietario' => $predio->main_propietario()->nombre_propietario,
                                'direccion' => $predio->latest_informacion()->direccion
                            ]);
                        }
                    }

                    fclose($csv);

                    return $data;
                } else {
                    return null;
                }
            }
        ]);
    }

    public function show_pdf(FacturaMasiva $facturaMasiva)
    {
        if (app()->isLocal()) {
            $url = 'http://financiero.localhost';
        } else {
            $url = 'https://' . tenant()->id . '.ideal-10.com';
        }

        if (! file_exists($facturaMasiva->path . 'consulta.pdf')) {
            $pdf_request = Http::sink($facturaMasiva->path . 'consulta.pdf')
                ->timeout(120)
                ->get($url . '/ams-pdf-factura_masivas', [
                    'input' => $facturaMasiva->path . 'consulta.csv',
                    'date' => $facturaMasiva->created_at->toDateString(),
                ]);

            if ($pdf_request->successful()) {
                return response($pdf_request->body(), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' =>
                        'attachment; filename=consulta_' .
                        $facturaMasiva->created_at->toDateString() . '.pdf',
                    'Access-Control-Expose-Headers' => 'Content-Disposition',
                    'Pragma' => 'no-cache',
                    'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                    'Expires' => '0'
                ]);
            } else {
                if ($pdf_request->badRequest()) {
                    $error = ', ' . $pdf_request->body();
                }

                return redirect()->back()->withErrors(['pdf' => 'Error al generar el PDF!' . $error ?? '']);
            }
        }

        return response(file_get_contents($facturaMasiva->path . 'consulta.pdf'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>
                'attachment; filename=consulta_' .
                $facturaMasiva->created_at->toDateString() . '.pdf',
            'Access-Control-Expose-Headers' => 'Content-Disposition',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ]);
    }

    public function show_one_pdf(FacturaMasiva $facturaMasiva, int $resolucion)
    {
        if (app()->isLocal()) {
            $url = 'http://financiero.localhost';
        } else {
            $url = 'https://' . tenant()->id . '.ideal-10.com';
        }

        $pdf_data = Http::withHeaders(['Content-Type' => 'application/pdf'])
            ->get($url . '/ams-pdf-factura_masivas', [
                'input' => $facturaMasiva->path . 'consulta.csv',
                'date' => $facturaMasiva->created_at->toDateString(),
                'resolucion' => $resolucion
            ])
            ->body();

        return response($pdf_data, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>
                'attachment; filename=consulta_' .
                $facturaMasiva->created_at->toDateString() . '_' .
                $resolucion . '.pdf',
            'Access-Control-Expose-Headers' => 'Content-Disposition',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FacturaMasiva $facturaMasiva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FacturaMasiva $facturaMasiva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FacturaMasiva $facturaMasiva)
    {
        //
    }
}
