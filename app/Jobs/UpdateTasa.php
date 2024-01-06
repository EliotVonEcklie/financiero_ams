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

class UpdateTasa implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 2000;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Avaluo::where('codigo_destino_economico_id', 2)
            ->where('tasa_por_mil', -1)
            ->chunk(1000, function ($avaluos) {
                foreach ($avaluos as $avaluo) {
                    $estratificaciones = Estratificacion::where([
                        'vigencia' => $avaluo->vigencia,
                        'predio_tipo_id' => $avaluo->predio_tipo_id,
                        'destino_economico_id' => $avaluo->codigo_destino_economico->destino_economico->id
                    ])->get();

                    if ($estratificaciones->count() === 0) {
                        continue;
                    }

                    foreach($estratificaciones as $estratificacion) {
                        if ($estratificacion->tarifa_type === '\App\Models\RangoAvaluo') {
                            $rangoAvaluo = $estratificacion->tarifa;

                            $vigencia_unidad = VigenciaUnidadMonetaria::
                                where('unidad_monetaria_id', $rangoAvaluo->unidad_monetaria->id)
                                ->where('vigencia', $avaluo->vigencia)
                                ->first();

                            $valor_avaluo = $avaluo->valor_avaluo;

                            $desde = $rangoAvaluo->desde;
                            $hasta = $rangoAvaluo->hasta;

                            $desde *= $vigencia_unidad->valor;
                            $hasta *= $vigencia_unidad->valor;

                            if ($valor_avaluo >= $desde && $valor_avaluo <= $hasta) {
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
            });
    }
}
