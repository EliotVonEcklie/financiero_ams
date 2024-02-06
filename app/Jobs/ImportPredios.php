<?php

namespace App\Jobs;

use App\Models\CodigoDestinoEconomico;
use App\Models\Predio;
use App\Models\PredioEstrato;
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
            ->select(
                'codigocatastral', 'tot', 'vigencia',
                'pago', 'avaluo', 'tasa', 'destino_economico',
                'ha', 'met2', 'areacon', 'estratos'
            )
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
        $predio = Predio::firstWhere('codigo_catastro', substr($tesopredioavaluo->codigocatastral, 0, 30));

        if ($predio === null) {
            $predio = Predio::create([
                'codigo_catastro' => substr($tesopredioavaluo->codigocatastral, 0, 30),
                'total' => (int) (($tesopredioavaluo->tot == '') ? 1 : $tesopredioavaluo->tot)
            ]);
        }

        $vigencia = strlen($tesopredioavaluo->vigencia) == 2
            ? '20' . $tesopredioavaluo->vigencia
            : substr($tesopredioavaluo->vigencia, 0, 4);

        $avaluo = $predio->avaluos()->firstWhere('vigencia', $vigencia);

        if ($avaluo === null) {
            $avaluo = $predio->avaluos()->create([
                'vigencia' => (int) $vigencia,
                'pagado' => $tesopredioavaluo->pago != 'N',
                'valor_avaluo' => (int) $tesopredioavaluo->avaluo
            ]);
        } else if (! $avaluo->pagado) {
            $avaluo->update([
                'pagado' => $tesopredioavaluo->pago != 'N'
            ]);
        }

        if ($avaluo->vigencia != now()->year) {
            $predio->avaluos()->firstWhere('vigencia', $vigencia)->update([
                'tasa_por_mil' => (float) $tesopredioavaluo->tasa
            ]);
        }

        $info = $predio->informacion_on($vigencia);

        $fecha_vigencia = Carbon::create($vigencia);

        $predio_tipo = substr($tesopredioavaluo->codigocatastral, 0, 2) === '00' ? 1 : 2;

        if ($info === null || $fecha_vigencia != $info->created_at) {
            $codigo_destino_economico = CodigoDestinoEconomico::firstWhere('codigo', $tesopredioavaluo->destino_economico);

            if ($codigo_destino_economico === null) {
                Log::warning('Teso predio avaluo informacion invalida: ' . $tesopredioavaluo->codigocatastral . ' ' . $vigencia);
                return;
            }

            $info = $predio->informacions()->create([
                'created_at' => $fecha_vigencia,
                'direccion' => '',
                'hectareas' => (int) $tesopredioavaluo->ha,
                'metros_cuadrados' => (int) $tesopredioavaluo->met2,
                'area_construida' => (int) $tesopredioavaluo->areacon,
                'predio_tipo_id' => $predio_tipo,
                'codigo_destino_economico_id' => $codigo_destino_economico->id
            ]);
        }

        $predio_estrato = PredioEstrato::firstWhere('estrato', $tesopredioavaluo->estratos);

        if ($predio_tipo === 2) {
            $info->update([
                'predio_estrato_id' => $predio_estrato?->id
            ]);
        }
    }
}
