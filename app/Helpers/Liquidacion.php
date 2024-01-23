<?php

namespace App\Helpers;

use App\Models\Avaluo;
use App\Models\Descuento;
use App\Models\Estatuto;
use App\Models\Interes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Liquidacion
{
    private Collection $estatutos;
    private int $incentivo;
    private int $intereses;

    public array $avaluos;
    public float $total_liquidacion = 0;
    public float $total_valor_avaluo = 0;
    public float $total_predial = 0;
    public float $total_predial_intereses = 0;
    public float $total_bomberil = 0;
    public float $total_bomberil_intereses = 0;
    public float $total_ambiental = 0;
    public float $total_ambiental_intereses = 0;
    public float $total_alumbrado = 0;
    public float $total_descuentos = 0;
    public float $total_intereses = 0;

    public function __construct(array $avaluos)
    {
        $this->estatutos = Estatuto::all();
        $this->incentivo = Descuento::getDescuentoIncentivo();
        $this->intereses = Descuento::getDescuentoIntereses();
        $this->avaluos = $avaluos;

        $liquidacion = [];

        foreach ($this->avaluos as $avaluo) {
            array_push($liquidacion, $this->liquidar($avaluo));
        }

        return $liquidacion;
    }

    private function liquidar(Avaluo $avaluo)
    {
        $result = [];

        $result['estatuto'] = $this->estatutos
            ->where('vigencia_desde', '<=', $avaluo->vigencia)
            ->where('vigencia_hasta', '>=', $avaluo->vigencia)
            ->first();

        if (!isset($result['estatuto'])) {
            return null;
        }

        $result['valor_avaluo'] = $avaluo->valor_avaluo;
        $result['tasa_por_mil'] = $avaluo->tasa_por_mil;
        $result['predial'] = $this->calculate_tarifa($result['valor_avaluo'], $result['tasa_por_mil']);

        if ($result['estatuto']->bomberil) {
            $result['bomberil'] = $this->calculate_tarifa(
                $result['estatuto']->bomberil_predial ? $result['predial'] : $result['valor_avaluo'],
                $result['estatuto']->bomberil_tasa,
                $result['estatuto']->bomberil_tarifa
            );
        }

        if ($result['estatuto']->ambiental) {
            $result['ambiental'] = $this->calculate_tarifa(
                $result['estatuto']->ambiental_predial ? $result['predial'] : $result['valor_avaluo'],
                $result['estatuto']->ambiental_tasa,
                $result['estatuto']->ambiental_tarifa
            );
        }

        if ($result['estatuto']->alumbrado) {
            if ($result['estatuto']->alumbrado_urbano && $avaluo->predio_tipo->codigo === '01') {
                $result['alumbrado'] = $this->calculate_tarifa(
                    $result['predial'],
                    $result['estatuto']->alumbrado_tasa,
                    $result['estatuto']->alumbrado_tarifa
                );
            } else if ($result['estatuto']->alumbrado_rural && $avaluo->predio_tipo->codigo === '00') {
                $result['alumbrado'] = $this->calculate_tarifa(
                    $result['predial'],
                    $result['estatuto']->alumbrado_tasa,
                    $result['estatuto']->alumbrado_tarifa
                );
            }
        }

        $result['total_liquidacion'] = $result['predial'] + $result['bomberil'] + $result['ambiental'] + $result['alumbrado'] + $result['estatuto']->recibo_caja;

        if ($incentivo > 0) {
            $result['total_descuentos'] = $result['total_liquidacion'] * ($incentivo / 100);
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

        return [

        ];
    }

    private function calculate_tarifa(float $value, float $tarifa, bool $is_tasa_por_mil = true): float
    {
        if ($is_tasa_por_mil) {
            return $value * ($tarifa / 1000);
        } else {
            return $value * ($tarifa / 100);
        }
    }
}
