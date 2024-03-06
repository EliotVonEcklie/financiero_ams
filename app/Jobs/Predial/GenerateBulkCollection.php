<?php

namespace App\Jobs\Predial;

use App\Helpers\Liquidacion;
use App\Models\FacturaMasiva;
use App\Models\FacturaPredial;
use App\Models\Predio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class GenerateBulkCollection implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 5000;

    private Collection $predios;

    /**
     * Create a new job instance.
     */
    public function __construct(public FacturaMasiva $facturaMasiva) {}

    /**
     * @return resource|false
     */
    private function create_csv($path)
    {
        $csv = fopen($path . 'consulta.csv', 'w');

        if (! $csv) return false;

        fputcsv($csv, ['predio_id', 'resolucion', 'codigo_catastro', 'vigencia', 'valor_avaluo',
            'tasa_por_mil', 'predial', 'predial_descuento', 'bomberil',
            'ambiental', 'alumbrado', 'total_liquidacion', 'dias_mora',
            'predial_intereses', 'predial_descuento_intereses',
            'bomberil_intereses', 'bomberil_descuento_intereses',
            'ambiental_intereses', 'ambiental_descuento_intereses',
            'descuento_intereses', 'total_intereses']);

        return $csv;
    }

    /**
     * @param resource $csv
     */
    private function append_csv($csv, array $liquidacion, int $resolucion): void
    {
        foreach ($liquidacion['vigencias'] as $result) {
            fputcsv($csv, [
                $liquidacion['predio_id'],
                $resolucion,
                $liquidacion['codigo_catastro'],
                $result['vigencia'],
                $result['valor_avaluo'],
                $result['tasa_por_mil'],
                $result['predial'],
                $result['predial_descuento'],
                $result['bomberil'],
                $result['ambiental'],
                $result['alumbrado'],
                $result['total_liquidacion'],
                $result['dias_mora'],
                $result['predial_intereses'],
                $result['predial_descuento_intereses'],
                $result['bomberil_intereses'],
                $result['bomberil_descuento_intereses'],
                $result['ambiental_intereses'],
                $result['ambiental_descuento_intereses'],
                $result['descuento_intereses'],
                $result['total_intereses']
            ]);
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $dir_path = 'factura_masivas/consulta_' . now()->toAtomString() . '/';
        Storage::createDirectory('factura_masivas');
        Storage::createDirectory($dir_path);
        $path = Storage::path($dir_path);

        $csv = $this->create_csv($path);

        if (! $csv) return;

        $resolucion = FacturaMasiva::where('id', '<', $this->facturaMasiva->id)
            ->orderByDesc('id')
            ->first()?->last_resolucion ?? 0;

        $resoluciones_ids = [];
        //$facturas = collect();

        if ($this->facturaMasiva->vigencias > 0) {
            $vigencias = [];

            for ($s = now()->year - $this->facturaMasiva->vigencias + 1, $y = 0; $y < $this->facturaMasiva->vigencias; $y++) {
                $vigencias[$y] = $y + $s;
            }
        } else {
            $vigencias = null;
        }

        foreach (Predio::lazy() as $predio) {
            if ((! $this->facturaMasiva->rurales) && $predio->latest_informacion()->predio_tipo_id === 2) continue;
            if ((! $this->facturaMasiva->urbanos) && $predio->latest_informacion()->predio_tipo_id === 1) continue;

            $liquidacion = (new Liquidacion($predio, $vigencias))->toArray();

            if ($liquidacion['total_liquidacion'] < $this->facturaMasiva->min_deuda) continue;

            if ($liquidacion !== null && count($liquidacion['vigencias']) > 0) {
                // Calculate Resolucion
                if (! isset($resoluciones_ids[$liquidacion['predio_id']])) {
                    $resoluciones_ids[$liquidacion['predio_id']] = ++$resolucion;
                }

                // Save the liquidacion to a file
                $this->append_csv($csv, $liquidacion, $resolucion);

                /*
                $main_propietario = $predio->main_propietario();
                $latest_info = $predio->latest_informacion();

                if ($latest_info === null) continue;

                $destino_economico = $latest_info->codigo_destino_economico->destino_economico?->nombre ??
                    'Destino ' . $latest_info->codigo_destino_economico->codigo;

                // Save factura
                $facturas->push((object) [
                    'id' => $resolucion,
                    'ip' => null,
                    'data' => array_merge([
                        'codigo_catastro' => $predio->codigo_catastro,
                        'total' => sprintf('%03d', $predio->total),
                        'orden' => sprintf('%03d', $main_propietario->orden),
                        'valor_avaluo' => $predio->latest_avaluo()->valor_avaluo,
                        'documento' => $main_propietario->documento,
                        'nombre_propietario' => $main_propietario->nombre_propietario,
                        'direccion' => $latest_info->direccion,
                        'hectareas' => $latest_info->hectareas,
                        'metros_cuadrados' => $latest_info->metros_cuadrados,
                        'area_construida' => $latest_info->area_construida,
                        'predio_tipo' => $latest_info->predio_tipo->nombre,
                        'destino_economico' => $destino_economico,
                        'liquidacion' => $liquidacion
                    ]),
                    'created_at' => now(),
                    'state' => true
                ]);
                */
            }
        }

        fclose($csv);

        // Save part of the PDF of the liquidaciones to a file
        /*
        Pdf::loadView('pdf.factura_masiva', [
            'facturas' => $facturas
        ])->save($path . 'resoluciones.pdf');
        */

        $this->facturaMasiva->update([
            'last_resolucion' => $resolucion,
            'processing' => false,
            'path' => $dir_path
        ]);
    }
}
