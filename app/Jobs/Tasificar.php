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

class Tasificar implements ShouldQueue
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
        $estratificaciones = Estratificacion::all();
        $avaluos = Avaluo::where('tasa_por_mil', -1)->lazyById();

        foreach ($avaluos as $avaluo) {
            if ($avaluo->codigo_destino_economico->destino_economico === null) {
                continue;
            }

            $estratificacionesAvaluo = $estratificaciones->where('vigencia', $avaluo->vigencia)
                ->where('predio_tipo_id', $avaluo->predio_tipo->id)
                ->where('destino_economico_id', $avaluo->codigo_destino_economico->destino_economico->id)
                ->all();

            foreach($estratificacionesAvaluo as $estratificacion) {
                if ($estratificacion->tarifa_type === '\App\Models\RangoAvaluo') {
                    $rangoAvaluo = $estratificacion->tarifa;

                    if ($rangoAvaluo->unidad_monetaria->nombre === 'Unidad') {
                        $vigencia_unidad = VigenciaUnidadMonetaria::where('unidad_monetaria_id', $rangoAvaluo->unidad_monetaria->id)
                            ->first();

                        if ($vigencia_unidad === null || $vigencia_unidad->valor !== 1.0) {
                            throw new RuntimeException('La unidad monetaria "Unidad" no tiene valor 1!');
                        }
                    } else {
                        $vigencia_unidad = VigenciaUnidadMonetaria::
                            where('unidad_monetaria_id', $rangoAvaluo->unidad_monetaria->id)
                            ->where('vigencia', $avaluo->vigencia)
                            ->first();

                        if ($vigencia_unidad === null) {
                            throw new RuntimeException('No se encontró vigencia unidad monetaria para la vigencia ' . $avaluo->vigencia);
                        }
                    }

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
