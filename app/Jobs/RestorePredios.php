<?php

namespace App\Jobs;

use App\Models\Avaluo;
use App\Models\HistorialPredio;
use App\Models\Predio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RestorePredios implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 2400;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // save all predios information
        $predios = Predio::select('codigo_catastro', 'total',
                DB::raw('MIN(id) as first_id'),
                DB::raw('GROUP_CONCAT(id) as ids'),
                DB::raw('GROUP_CONCAT(orden) as ordenes')
            )
            ->groupBy('codigo_catastro', 'total')
            ->orderBy('codigo_catastro')
            ->lazy();

        $now = now();

        foreach ($predios as $predio) {
            $historial_predios = HistorialPredio::whereIn('predio_id', explode(',', $predio->ids))->get();
            $avaluos = Avaluo::where('predio_id', $predio->first_id)->get();

            $propietarios = [];
            $infos = [];
            $avals = [];

            foreach ($historial_predios as $prop) {
                array_push($propietarios,
                    $predio->codigo_catastro . ';' . $prop->predio->orden . ';' . $prop->fecha . ';' . $prop->tipo_documento . ';' . $prop->documento . ';' . $prop->nombre_propietario
                );
            }

            foreach ($historial_predios->where('predio_id', $predio->first_id)->all() as $info) {
                array_push($infos,
                    $predio->codigo_catastro . ';' . $info->fecha . ';' . $info->codigo_destino_economico_id . ';' . $info->direccion . ';' .
                    $info->hectareas . ';' . $info->metros_cuadrados . ';' . $info->area_construida . ';' . $info->predio_estrato_id . ';' . $info->predio_tipo_id
                );
            }

            foreach ($avaluos as $avaluo) {
                array_push($avals,
                    $predio->codigo_catastro . ';' . $avaluo->vigencia . ';' . $avaluo->pagado . ';' . $avaluo->valor_avaluo . ';' . $avaluo->tasa_por_mil
                );
            }

            Storage::append('dump/' . $now . '/informacion.csv', implode("\n", $infos));
            Storage::append('dump/' . $now . '/avaluos.csv', implode("\n", $avals));
            Storage::append('dump/' . $now . '/propietarios.csv', implode("\n", $propietarios));
            Storage::append('dump/' . $now . '/predios.csv', $predio->codigo_catastro . ';' . $predio->total . ';' . $predio->ids . ';' . $predio->ordenes);
        }
    }
}
