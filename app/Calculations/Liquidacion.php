<?php

namespace App\Calculations;

use App\Models\Avaluo;
use App\Models\Descuento;
use App\Models\Estatuto;
use App\Models\Interes;
use Illuminate\Support\Carbon;

class Liquidacion
{
    private Estatuto $estatuto;
    private Avaluo $avaluo;

    public float $valor_avaluo = 0;
    public float $valor_predial = 0;
    public float $predial_intereses = 0;
    public float $bomberil = 0;
    public float $bomberil_intereses = 0;
    public float $ambiental = 0;
    public float $ambiental_intereses = 0;
    public float $alumbrado = 0;
    public float $total_descuentos = 0;
    public float $total_intereses = 0;
    public float $dias_mora = 0;
    public float $descuento_intereses = 0;
    public float $total = 0;

    public function __construct(Avaluo $avaluo)
    {
        $this->avaluo = $avaluo;

        $this->estatuto = Estatuto::where('vigencia_desde', '<=', $avaluo->vigencia)
            ->where('vigencia_hasta', '>=', $avaluo->vigencia)
            ->first();

        if (!isset($this->estatuto)) {
            return null;
        }

        $this->valor_avaluo = $avaluo->valor_avaluo;
        $this->valor_predial = $this->calculate_tarifa($this->valor_avaluo, $avaluo->tasa_por_mil);

        if ($this->estatuto->bomberil) {
            $this->bomberil = $this->calculate_tarifa(
                $this->estatuto->bomberil_predial ? $this->valor_predial : $this->valor_avaluo,
                $this->estatuto->bomberil_tasa,
                $this->estatuto->bomberil_tarifa
            );
        }

        if ($this->estatuto->ambiental) {
            $this->ambiental = $this->calculate_tarifa(
                $this->estatuto->ambiental_predial ? $this->valor_predial : $this->valor_avaluo,
                $this->estatuto->ambiental_tasa,
                $this->estatuto->ambiental_tarifa
            );
        }

        if ($this->estatuto->alumbrado) {
            if ($this->estatuto->alumbrado_urbano && $avaluo->predio_tipo->codigo === '01') {
                $this->alumbrado = $this->calculate_tarifa(
                    $this->valor_predial,
                    $this->estatuto->alumbrado_tasa,
                    $this->estatuto->alumbrado_tarifa
                );
            } else if ($this->estatuto->alumbrado_rural && $avaluo->predio_tipo->codigo === '00') {
                $this->alumbrado = $this->calculate_tarifa(
                    $this->valor_predial,
                    $this->estatuto->alumbrado_tasa,
                    $this->estatuto->alumbrado_tarifa
                );
            }
        }

        $this->total = $this->bomberil + $this->ambiental + $this->alumbrado + $this->estatuto->recibo_caja;

        $this->do_mora();
    }

    private function do_mora() {
        $incentivo = Descuento::getDescuentoIncentivo();

        if ($incentivo > 0) {
            $this->total_descuentos = $this->total * ($incentivo / 100);
            $this->total -= $this->total_descuentos;
        } else {
            $from = new Carbon($this->avaluo->vigencia . '-01-01');

            $this->dias_mora = Interes::diasMora($from);

            $this->predial_intereses = Interes::calculateMoratorio($this->valor_predial, $from);
            $this->bomberil_intereses = Interes::calculateMoratorio($this->bomberil, $from);
            $this->ambiental_intereses = Interes::calculateMoratorio($this->ambiental, $from);

            $this->total_intereses = $this->predial_intereses + $this->bomberil_intereses + $this->ambiental_intereses;
            $this->descuento_intereses = $this->total_intereses * (Descuento::getDescuentoIntereses() / 100);
            $this->total_intereses -= $this->descuento_intereses;

            $this->total += $this->total_intereses /* - $this->descuento_intereses */;
        }
    }

    private function calculate_tarifa(float $value, float $tarifa, bool $is_tasa_por_mil = true): float {
        if ($is_tasa_por_mil) {
            return $value * ($tarifa / 1000);
        } else {
            return $value * ($tarifa / 100);
        }
    }

    public function toArray()
    {
        return [
            'vigencia' => $this->avaluo->vigencia,
            'total' => $this->total,
            'total_descuentos' => $this->total_descuentos,
            'total_intereses' => $this->total_intereses,
            'dias_mora' => $this->dias_mora,
            'descuento_intereses' => $this->descuento_intereses,
            'valor_predial' => $this->valor_predial,
            'predial_intereses' => $this->predial_intereses,
            'bomberil' => $this->bomberil,
            'bomberil_intereses' => $this->bomberil_intereses,
            'ambiental' => $this->ambiental,
            'ambiental_intereses' => $this->ambiental_intereses,
            'alumbrado' => $this->alumbrado,
            'recibo_caja' => $this->estatuto->recibo_caja,
            'estatuto' => [
                'norma_predial' => $this->estatuto->norma_predial,
                'bomberil' => $this->estatuto->bomberil,
                'ambiental' => $this->estatuto->ambiental,
                'alumbrado' => $this->estatuto->alumbrado
            ]
        ];
    }
}
