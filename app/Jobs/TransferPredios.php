<?php

namespace App\Jobs;

use App\Models\Predio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class TransferPredios implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 180;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach (Predio::lazy() as $predio) {
            $this->transfer_predio($predio);
            $this->transfer_avaluos($predio->avaluos);
        }
    }

    /**
     * Transfer a predio to the tesopredios table.
     *
     * @param Predio $predio The predio to transfer.
     */
    public function transfer_predio(Predio $predio) {
        // Format data for old database

        $tesopredios_data = [
            'cedulacatastral' => $predio->codigo_catastro,
            'ord' => sprintf("%03d", $predio->orden),
            'tot' => sprintf("%03d", $predio->total),
            'e' => '',
            'd' => $predio->latest_historial_predio()->tipo_documento,
            'documento' => $predio->latest_historial_predio()->documento,
            'nombrepropietario' => $predio->latest_historial_predio()->nombre_propietario,
            'direccion' => $predio->latest_historial_predio()->direccion,
            'ha' => $predio->latest_historial_predio()->hectareas,
            'met2' => $predio->latest_historial_predio()->metros_cuadrados,
            'areacon' => $predio->latest_historial_predio()->area_construida,
            'avaluo' => $predio->latest_avaluo()->valor_avaluo,
            'vigencia' => $predio->latest_avaluo()->vigencia,
            'estado' => 'S',
            'tipopredio' => strtolower($predio->latest_avaluo()->predio_tipo->nombre),
            'clasifica' => $predio->latest_avaluo()->predio_tipo->nombre === 'Rural' ? 1 : ($predio->latest_avaluo()->predio_tipo->nombre === 'Rural' ? 2 : 0),
            'estratos' => ''
        ];

        DB::table('tesopredios')->upsert($tesopredios_data, ['cedulacatastral', 'ord', 'tot'], [
            'e',
            'd',
            'documento',
            'nombrepropietario',
            'direccion',
            'ha',
            'met2',
            'areacon',
            'avaluo',
            'vigencia',
            'estado',
            'tipopredio',
            'clasifica',
            'estratos'
        ]);
    }

    /**
     * Transfer an avaluo to the tesoprediosavaluos table.
     *
     * @param \Illuminate\Support\Collection $avaluos The avaluos to transfer.
     */
    public function transfer_avaluos(Collection $avaluos) {
        foreach ($avaluos as $avaluo) {
            // Format data for old database

            $tesoprediosavaluos_data = [
                'vigencia' => $avaluo->vigencia,
                'codigocatastral' => $avaluo->predio->codigo_catastro,
                'avaluo' => $avaluo->valor_avaluo,
                'pago' => $avaluo->pagado ? 'S' : 'N',
                'estado' => 'S',
                'ord' => sprintf("%03d", $avaluo->predio->orden),
                'tot' => sprintf("%03d", $avaluo->predio->total),
                'ha' => $avaluo->hectareas,
                'met2' => $avaluo->metros_cuadrados,
                'areacon' => $avaluo->area_construida,
                'tasa' => $avaluo->tasa_por_mil,
                'tipopredio' => strtolower($avaluo->predio_tipo->nombre),
                'estratos' => '',
                'destino_economico' => $avaluo->codigo_destino_economico->codigo,
                'tasa_bomberil' => 0
            ];

            DB::table('tesoprediosavaluos')->upsert($tesoprediosavaluos_data, ['vigencia', 'codigocatastral'], [
                'avaluo',
                'pago',
                'estado',
                'tot',
                'ord',
                'ha',
                'met2',
                'areacon',
                'tasa',
                'tipopredio',
                'estratos',
                'destino_economico',
                'tasa_bomberil'
            ]);
        }
    }
}
