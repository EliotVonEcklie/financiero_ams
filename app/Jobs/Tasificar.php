<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Avaluo;
use App\Models\Estratificacion;
use App\Models\VigenciaUnidadMonetaria;
use RuntimeException;

class Tasificar implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 500;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $estratificaciones = Estratificacion::all();
        $avaluos = Avaluo::where('tasa_por_mil', -1)->lazyById(1000);

        foreach ($avaluos as $avaluo) {
            $estratificacionesAvaluo = $estratificaciones->where('vigencia', $avaluo->vigencia)
                ->where('predio_tipo_id', $avaluo->predio_tipo->id)
                ->where('destino_economico_id', $avaluo->codigo_destino_economico->destino_economico->id)
                ->all();

            foreach($estratificacionesAvaluo as $estratificacion) {
                if ($estratificacion->tarifa_type === '\App\Models\RangoAvaluo') {
                    $rangoAvaluo = $estratificacion->tarifa;

                    $vigencia_unidad = VigenciaUnidadMonetaria::
                        where('unidad_monetaria_id', $rangoAvaluo->unidad_monetaria->id)
                        ->where('vigencia', $avaluo->vigencia)
                        ->first();

                    $valor_avaluo = $avaluo->valor_avaluo;

                    $desde = $rangoAvaluo->desde * $vigencia_unidad->valor;
                    $hasta = $rangoAvaluo->hasta * $vigencia_unidad->valor;

                    if ($valor_avaluo >= $desde && ($hasta < 0 || $valor_avaluo <= $hasta)) {
                        $avaluo->tasa_por_mil = $estratificacion->tasa;
                        $avaluo->save();

                        break;
                    }
                } else if ($estratificacion->tarifa_type === '\App\Models\PredioEstrato') {
                    $predioEstrato = $estratificacion->tarifa;

                    if ($avaluo->predio_estrato_id === $predioEstrato->id) {
                        $avaluo->tasa_por_mil = $estratificacion->tasa;
                        $avaluo->save();

                        break;
                    }
                } else {
                    throw new RuntimeException('Tipo de tarifa no soportado');
                }
            }
        }
    }
}
