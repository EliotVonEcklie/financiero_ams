<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Avaluo;
use App\Models\Estatuto;
use App\Models\Estratificacion;
use App\Models\VigenciaUnidadMonetaria;
use Illuminate\Support\Facades\Log;

class Liquidar implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Avaluo::where('codigo_destino_economico_id', 2)
        ->where('tasa_por_mil', '<>', -1)
        ->chunk(1000, function ($avaluos) {
            foreach ($avaluos as $avaluo) {
                $estatuto = Estatuto::where('vigencia_desde', '>=', $avaluo->vigencia)
                    ->where('vigencia_hasta', '<=', $avaluo->vigencia)
                    ->first();

                $valor_avaluo = $avaluo->valor_avaluo;
                $valor_predial = $this->calculate_tarifa($valor_avaluo, $avaluo->tasa_por_mil);
                $liquidacion = 0;
                $bomberil = 0;
                $ambiental = 0;
                $alumbrado = 0;

                if ($estatuto->bomberil) {
                    $bomberil = $this->calculate_tarifa(
                        $estatuto->bomberil_predial ? $valor_predial : $valor_avaluo,
                        $estatuto->bomberil_tasa,
                        $estatuto->bomberil_tarifa
                    );
                }

                if ($estatuto->ambiental) {
                    $ambiental = $this->calculate_tarifa(
                        $estatuto->ambiental_predial ? $valor_predial : $valor_avaluo,
                        $estatuto->ambiental_tasa,
                        $estatuto->ambiental_tarifa
                    );
                }



                $liquidacion += $bomberil + $ambiental + $alumbrado + $estatuto->recibo_caja;

                Log::warn('Id predio: ' . $avaluo->predio->id . ', Bomberil: ' . $bomberil . ', Ambiental: ' . $ambiental . ', Alumbrado: ' . $alumbrado . ', Liquidacion: ' . $liquidacion);
            }
        });
    }

    public function calculate_tarifa(float $value, float $tarifa, bool $is_tasa_por_mil = true): float {
        if ($is_tasa_por_mil) {
            return $value * ($tarifa / 1000);
        } else {
            return $value * ($tarifa / 100);
        }
    }
}
