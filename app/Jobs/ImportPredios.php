<?php

namespace App\Jobs;

use App\Models\Predio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportPredios implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 2400;

    private $tesoprediosavaluos;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Predio::all()->pluck('codigo_catastro');

        $this->tesoprediosavaluos = DB::table('tesoprediosavaluos')
            ->select('codigocatastral', 'tot', 'vigencia', 'pago', 'avaluo', 'tasa')
            ->whereNotIn('codigocatastral', function (Builder $query) {
                $query->select('codigo_catastro')->from('predios');
            })
            ->orderBy('vigencia')
            ->lazy(500);

        foreach ($this->tesoprediosavaluos as $tesopredioavaluo) {
            if (strlen($tesopredioavaluo->codigocatastral) >= 25) {
                $this->import($tesopredioavaluo);
            }
        }
    }

    private function import($tesopredioavaluo)
    {
        $predio = Predio::updateOrCreate([
            'codigo_catastro' => substr($tesopredioavaluo->codigocatastral, 0, 30)
        ], [
            'total' => (int) (($tesopredioavaluo->tot == '') ? 1 : $tesopredioavaluo->tot)
        ]);

        $avaluo = $predio->avaluos()->firstWhere('vigencia', $tesopredioavaluo->vigencia);

        if ($avaluo !== null && ! $avaluo->pagado) {
            $avaluo->pagado = $tesopredioavaluo->pago != 'N';
            $avaluo->save();
        } else if ($avaluo === null) {
            $avaluo = $predio->avaluos()->create([
                'vigencia' => (int) substr($tesopredioavaluo->vigencia, 0, 4),
                'pagado' => $tesopredioavaluo->pago != 'N',
                'valor_avaluo' => (int) $tesopredioavaluo->avaluo
            ]);
        }

        $info = $predio->informacion_on($tesopredioavaluo->avaluo);

        $fecha_vigencia = Carbon::create($tesopredioavaluo->vigencia);

        if ($info !== null && $info->created_at == Carbon::create($fecha_vigencia)) {
            return;
        }

        if (strlen($tesopredioavaluo->destino_economico) < 1) {
            Log::warning('Teso predio avaluo informacion invalida: ' . $tesopredioavaluo->codigocatastral . ' ' . $tesopredioavaluo->vigencia);
            return;
        }

        $predio->informacions()->create([
            'created_at' => $fecha_vigencia,
            'direccion' => '',
            'hectareas' => (int) $tesopredioavaluo->ha,
            'metros_cuadrados' => (int) $tesopredioavaluo->met2,
            'area_construida' => (int) $tesopredioavaluo->areacon,
            'predio_tipo_id' => substr($tesopredioavaluo->codigocatastral, 0, 2) === '00' ? 1 : 2,
        ]);
    }
}
