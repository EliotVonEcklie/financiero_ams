<?php

namespace App\Jobs\Predial;

use App\Helpers\Liquidacion;
use App\Models\FacturaMasiva;
use App\Models\Predio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GenerateCarteraPredial implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 10_000;

    /**
     * Create a new job instance.
     */
    public function __construct(public FacturaMasiva $facturaMasiva, public $predios = null) {}

    /**
     * @return resource|false
     */
    private function create_csv($path)
    {
        $csv = fopen($path . 'cartera.csv', 'w');

        if (! $csv) return false;

        fputcsv($csv, [
            'predio_id', 'codigo_catastro', 'direccion', 'documento',
            'nombre_propietario', 'vigencia', 'valor_avaluo', 'tasa_por_mil',
            'predial', 'predial_descuento', 'bomberil', 'ambiental',
            'alumbrado', 'total_liquidacion', 'dias_mora', 'predial_intereses',
            'predial_descuento_intereses', 'bomberil_intereses',
            'bomberil_descuento_intereses', 'ambiental_intereses',
            'ambiental_descuento_intereses', 'descuento_intereses',
            'total_intereses'
        ]);

        return $csv;
    }

    /**
     * @param resource $csv
     */
    private function append_csv($csv, array $liquidacion): void
    {
        $predio = Predio::find($liquidacion['predio_id']);
        $propietario = $predio->main_propietario();

        foreach ($liquidacion['vigencias'] as $result) {
            fputcsv($csv, [
                $liquidacion['predio_id'],
                $predio->codigo_catastro,
                $predio->latest_informacion()->direccion,
                $propietario->documento,
                $propietario->nombre_propietario,
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
        $dir_path = 'cartera_predials/' . now()->toAtomString() . '/';
        Storage::createDirectory('cartera_predials');
        Storage::createDirectory($dir_path);
        $path = Storage::path($dir_path);

        $csv = $this->create_csv($path);

        if (! $csv) return;

        if ($this->facturaMasiva->vigencias > 0) {
            $vigencias = [];

            for ($s = now()->year - $this->facturaMasiva->vigencias + 1, $y = 0;
                $y < $this->facturaMasiva->vigencias; $y++
            ) {
                $vigencias[$y] = $y + $s;
            }
        } else {
            $vigencias = null;
        }

        $this->predios ??= Predio::lazy();

        $liquidador = new Liquidacion(false);

        foreach ($this->predios as $predio) {
            if ((! $this->facturaMasiva->rurales) && $predio->latest_informacion()->predio_tipo_id === 2) continue;
            if ((! $this->facturaMasiva->urbanos) && $predio->latest_informacion()->predio_tipo_id === 1) continue;

            $liquidador->liquidar($predio, $vigencias);
            $liquidacion = $liquidador->toArray();

            if ($liquidacion['total_liquidacion'] < $this->facturaMasiva->min_deuda) continue;

            if ($liquidacion !== null && count($liquidacion['vigencias']) > 0) {
                // Save the liquidacion to a file
                $this->append_csv($csv, $liquidacion);
            }
        }

        fclose($csv);

        $this->facturaMasiva->update([
            'processing' => false,
            'path' => $path . 'consulta.csv'
        ]);
    }
}
