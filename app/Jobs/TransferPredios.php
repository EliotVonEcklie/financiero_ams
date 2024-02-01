<?php

namespace App\Jobs;

use App\Models\Predio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class TransferPredios implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 2400;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach (Predio::lazy() as $predio) {
            $this->transfer_predio($predio);
            $this->transfer_avaluos($predio);
        }
    }

    /**
     * Transfer a predio to the tesopredios table.
     *
     * @param Predio $predio The predio to transfer.
     */
    public function transfer_predio(Predio $predio) {
        $propietario = $predio->main_propietario();
        $latest_info = $predio->latest_informacion();
        $latest_avaluo = $predio->latest_avaluo();

        // Format data for old database
        $tesopredios_data = [
            'cedulacatastral' => $predio->codigo_catastro,
            'ord' => sprintf('%03d', $predio->orden),
            'tot' => sprintf('%03d', $predio->total),
            'e' => '',
            'd' => $propietario->tipo_documento,
            'documento' => $propietario->documento,
            'nombrepropietario' => $propietario->nombre_propietario,
            'direccion' => $latest_info->direccion,
            'ha' => $latest_info->hectareas,
            'met2' => $latest_info->metros_cuadrados,
            'areacon' => $latest_info->area_construida,
            'avaluo' => $latest_avaluo->valor_avaluo,
            'vigencia' => $latest_avaluo->vigencia,
            'estado' => 'S',
            'tipopredio' => strtolower(substr($latest_info->predio_tipo->nombre, 0, 6)),
            'clasifica' => $latest_info->predio_tipo->nombre === 'Rural' ? 1 : ($latest_info->predio_tipo->nombre === 'Urbano' ? 2 : 0),
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
    public function transfer_avaluos(Predio $predio) {
        foreach ($predio->propietarios() as $propietario) {
            $avaluo = $predio->avaluos()
                ->where('vigencia', $propietario->created_at->year)
                ->first();
            $informacion = $predio->informacions()
                ->where('created_at', $propietario->created_at)
                ->first();

            // Format data for old database
            $tesoprediosavaluos_data = [
                'vigencia' => $propietario->created_at->year,
                'codigocatastral' => $predio->codigo_catastro,
                'avaluo' => $avaluo->valor_avaluo,
                'pago' => $avaluo->pagado ? 'S' : 'N',
                'estado' => 'S',
                'ord' => sprintf("%03d", $propietario->orden),
                'tot' => sprintf("%03d", $predio->total),
                'ha' => $informacion->hectareas,
                'met2' => $informacion->metros_cuadrados,
                'areacon' => $informacion->area_construida,
                'tasa' => $avaluo->tasa_por_mil,
                'tipopredio' => substr($informacion->predio_tipo->nombre, 0, 5) === 'Rural' ? 1 : (substr($informacion->predio_tipo->nombre, 0, 6) === 'Urbano' ? 2 : 0),
                'estratos' => '',
                'destino_economico' => $informacion->codigo_destino_economico->codigo,
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
