<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Estratificacion;
use App\Models\Predio;
use App\Models\PredioAvaluo;
use App\Models\PredioInformacion;
use App\Models\VigenciaUnidadMonetaria;
use Illuminate\Support\Facades\Log;
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

    private $vigencia_unidad_monetarias;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $estratificaciones = Estratificacion::all();
        $this->vigencia_unidad_monetarias = VigenciaUnidadMonetaria::all();

        foreach (PredioAvaluo::where('tasa_por_mil', -1)
            ->orderBy('predio_id')
            ->orderBy('vigencia')
            ->lazyById() as $avaluo) {

            $informacion = $avaluo->predio->informacion_on($avaluo->vigencia);

            if ($informacion === null) {
                Log::error('tenant: ' . tenant()->id . ', No se encontró información para el predio: ' . $avaluo->predio->id);
                continue;
            }

            $this->tasificar_avaluo($avaluo, $informacion, $estratificaciones);
        }
    }

    /**
     * Tasificar an avaluo.
     *
     * @param \App\Models\Avaluo $avaluo The avaluo to tasificar.
     * @param \App\Models\PredioInformacion $informacion The informacion to use.
     * @param \Illuminate\Support\Collection $estratificaciones The estratificaciones to use.
     */
    private function tasificar_avaluo(PredioAvaluo $avaluo, PredioInformacion $informacion, $estratificaciones): void
    {
        if ($informacion->codigo_destino_economico->destino_economico === null) {
            Log::error('tenant: ' . tenant()->id . ', No se encontró destino económico para el predio: ' . $avaluo->predio->id . ', vigencia: ' . $avaluo->vigencia);
            return;
        }

        $estratificacionesAvaluo = $estratificaciones
            ->where('vigencia', $avaluo->vigencia)
            ->where('predio_tipo_id', $informacion->get_predio_tipo())
            ->where('destino_economico_id', $informacion->codigo_destino_economico->destino_economico->id);

        if ($estratificacionesAvaluo->count() === 0) {
            Log::warning('tenant: ' . tenant()->id . ', No se encontró estratificación para el predio: ' . $avaluo->predio->id . ', vigencia: ' . $avaluo->vigencia);
            return;
        }

        $found = false;

        foreach($estratificacionesAvaluo as $estratificacion) {
            if ($this->check_estratificacion($avaluo, $informacion, $estratificacion)) {
                $found = true;
                break;
            }
        }

        if (! $found) {
            Log::warning('tenant: ' . tenant()->id . ', No se tasificó el predio: ' . $avaluo->predio->id . ', vigencia: ' . $avaluo->vigencia);
        }
    }

    /**
     * Check if an avaluo is in a estratificacion.
     *
     * @param \App\Models\Avaluo $avaluo The avaluo to check.
     * @param \App\Models\PredioInformacion $informacion The informacion to use.
     * @param \App\Models\Estratificacion $estratificacion The estratificacion to check.
     * @return bool True if the avaluo is in the estratificacion, false otherwise.
     */
    private function check_estratificacion($avaluo, $informacion, $estratificacion)
    {
        if ($estratificacion->tarifa_type === '\App\Models\RangoAvaluo') {
            $rangoAvaluo = $estratificacion->tarifa;

            if ($rangoAvaluo->unidad_monetaria->nombre === 'Unidad') {
                $vigencia_unidad = $this->vigencia_unidad_monetarias
                    ->where('unidad_monetaria_id', $rangoAvaluo->unidad_monetaria->id)
                    ->first();

                if ($vigencia_unidad === null || $vigencia_unidad->valor != 1.0) {
                    throw new RuntimeException('La unidad monetaria "Unidad" no tiene valor 1!');
                }
            } else {
                $vigencia_unidad = $this->vigencia_unidad_monetarias
                    ->where('unidad_monetaria_id', $rangoAvaluo->unidad_monetaria->id)
                    ->where('vigencia', $avaluo->vigencia)
                    ->first();

                if ($vigencia_unidad === null) {
                    Log::error('No se encontró vigencia unidad monetaria para la vigencia ' . $avaluo->vigencia);
                    return false;
                }
            }

            $valor_avaluo = ceil($avaluo->valor_avaluo / $vigencia_unidad->valor);
            $desde = (float) $rangoAvaluo->desde;
            $hasta = (float) $rangoAvaluo->hasta;

            if ($valor_avaluo >= $desde && (($hasta == -1.0) || $valor_avaluo <= $hasta)) {
                $avaluo->tasa_por_mil = $estratificacion->tasa;
                $avaluo->save();

                return true;
            } else {
                Log::debug('tenant: ' . tenant()->id . ', El avaluo ' . $valor_avaluo . ' no está en el rango (' . $desde . ', ' . $hasta . ') ' . $vigencia_unidad->unidad_monetaria->nombre);
            }
        } else if ($estratificacion->tarifa_type === '\App\Models\PredioEstrato') {
            $predioEstrato = $estratificacion->tarifa;

            if ($informacion->predio_estrato_id === $predioEstrato->id) {
                $avaluo->tasa_por_mil = $estratificacion->tasa;
                $avaluo->save();

                return true;
            }
        } else {
            throw new RuntimeException('Tipo de tarifa no soportado');
        }

        return false;
    }
}
