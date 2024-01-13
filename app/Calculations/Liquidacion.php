<?php

namespace App\Calculations;

use App\Models\Avaluo;
use App\Models\Estatuto;

class Liquidacion
{
    public Estatuto $estatuto;
    public float $valor_avaluo = 0;
    public float $valor_predial = 0;
    public float $bomberil = 0;
    public float $ambiental = 0;
    public float $alumbrado = 0;
    public float $total = 0;

    public function __construct(Avaluo $avaluo)
    {
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
    }

    public function calculate_tarifa(float $value, float $tarifa, bool $is_tasa_por_mil = true): float {
        if ($is_tasa_por_mil) {
            return $value * ($tarifa / 1000);
        } else {
            return $value * ($tarifa / 100);
        }
    }

    public function toArray()
    {
        return [
            'total' => $this->total,
            'valor_predial' => $this->valor_predial,
            'bomberil' => $this->bomberil,
            'ambiental' => $this->ambiental,
            'alumbrado' => $this->alumbrado,
            'recibo_caja' => $this->estatuto->recibo_caja,
            'estatuto' => [
                'bomberil' => $this->estatuto->bomberil,
                'ambiental' => $this->estatuto->ambiental,
                'alumbrado' => $this->estatuto->alumbrado
            ]
        ];
    }
}
