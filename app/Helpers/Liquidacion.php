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
    private Collection $avaluos;

    public array $vigencias = [];
    public int $descuento_incentivo = 0;
    public int $descuento_intereses = 0;
    public float $total_liquidacion = 0;
    public float $total_valor_avaluo = 0;
    public float $total_predial = 0;
    public float $total_predial_descuento = 0;
    public float $total_predial_intereses = 0;
    public float $total_predial_descuento_intereses = 0;
    public float $total_bomberil = 0;
    public float $total_bomberil_intereses = 0;
    public float $total_bomberil_descuento_intereses = 0;
    public float $total_ambiental = 0;
    public float $total_ambiental_intereses = 0;
    public float $total_ambiental_descuento_intereses = 0;
    public float $total_alumbrado = 0;
    public float $total_intereses = 0;

    public function __construct(Collection|array $avaluos)
    {
        $this->estatutos = Estatuto::all();
        $this->descuento_incentivo = Descuento::getDescuentoIncentivo();
        $this->descuento_intereses = Descuento::getDescuentoIntereses();
        $this->avaluos = Collection::make($avaluos);

        foreach ($this->avaluos as $avaluo) {
            array_push($this->vigencias, $this->liquidar($avaluo));
        }
    }

    public function toArray() : array
    {
        return [
            'vigencias' => $this->vigencias,
            'total_liquidacion' => $this->total_liquidacion,
            'total_valor_avaluo' => $this->total_valor_avaluo,
            'total_predial' => $this->total_predial,
            'total_predial_descuento' => $this->total_predial_descuento,
            'total_predial_intereses' => $this->total_predial_intereses,
            'total_predial_descuento_intereses' => $this->total_predial_descuento_intereses,
            'total_bomberil' => $this->total_bomberil,
            'total_bomberil_intereses' => $this->total_bomberil_intereses,
            'total_bomberil_descuento_intereses' => $this->total_bomberil_descuento_intereses,
            'total_ambiental' => $this->total_ambiental,
            'total_ambiental_intereses' => $this->total_ambiental_intereses,
            'total_ambiental_descuento_intereses' => $this->total_ambiental_descuento_intereses,
            'total_alumbrado' => $this->total_alumbrado,
            'total_intereses' => $this->total_intereses
        ];
    }

    private function liquidar(Avaluo $avaluo)
    {
        $result = [
            'vigencia' => $avaluo->vigencia,
            'estatuto' => $this->estatutos
                ->where('vigencia_desde', '<=', $avaluo->vigencia)
                ->where('vigencia_hasta', '>=', $avaluo->vigencia)
                ->first(),
            'valor_avaluo' => 0,
            'tasa_por_mil' => 0,
            'predial' => 0,
            'predial_descuento' => 0,
            'bomberil' => 0,
            'ambiental' => 0,
            'alumbrado' => 0,
            'total_liquidacion' => 0,
            'dias_mora' => 0,
            'predial_intereses' => 0,
            'predial_descuento_intereses' => 0,
            'bomberil_intereses' => 0,
            'bomberil_descuento_intereses' => 0,
            'ambiental_intereses' => 0,
            'ambiental_descuento_intereses' => 0,
            'descuento_intereses' => 0,
            'total_intereses' => 0
        ];

        if ($result['estatuto'] === null) {
            return $result;
        }

        $result['valor_avaluo'] = Round::pesos($avaluo->valor_avaluo);
        $result['tasa_por_mil'] = $avaluo->tasa_por_mil;
        $result['predial'] = $this->calculate_tarifa($result['valor_avaluo'], $result['tasa_por_mil']);

        if ($this->descuento_incentivo > 0) {
            $result['predial_descuento'] = $this->calculate_tarifa($result['predial'], $this->descuento_incentivo, false);
            $result['predial'] -= $result['predial_descuento'];
        }

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

        $result['total_liquidacion'] = Round::pesos($result['predial'] + $result['bomberil'] + $result['ambiental'] + $result['alumbrado'] + $result['estatuto']->recibo_caja);

        if ($this->descuento_incentivo === 0) {
            $from = new Carbon($result['vigencia'] . '-01-01');

            $result['dias_mora'] = Interes::diasMora($from);

            $result['predial_intereses'] = Interes::calculateMoratorio($result['predial'], $from);
            $result['predial_descuento_intereses'] = $this->calculate_tarifa($result['predial_intereses'], $this->descuento_intereses, false);

            $result['bomberil_intereses'] = Interes::calculateMoratorio($result['bomberil'], $from);
            $result['bomberil_descuento_intereses'] = $this->calculate_tarifa($result['bomberil_intereses'], $this->descuento_intereses, false);

            $result['ambiental_intereses'] = Interes::calculateMoratorio($result['ambiental'], $from);
            $result['ambiental_descuento_intereses'] = $this->calculate_tarifa($result['ambiental_intereses'], $this->descuento_intereses, false);

            $result['descuento_intereses'] = Round::pesos($result['predial_descuento_intereses'] + $result['bomberil_descuento_intereses'] + $result['ambiental_descuento_intereses']);

            $result['total_intereses'] = Round::pesos(($result['predial_intereses'] + $result['bomberil_intereses'] + $result['ambiental_intereses']) -
                $result['descuento_intereses']);

            $result['total_liquidacion'] += $result['total_intereses'];
        }

        $this->total_liquidacion += $result['total_liquidacion'];
        $this->total_valor_avaluo += $result['valor_avaluo'];
        $this->total_predial += $result['predial'];
        $this->total_predial_descuento += $result['predial_descuento'];
        $this->total_predial_intereses += $result['predial_intereses'];
        $this->total_predial_descuento_intereses += $result['predial_descuento_intereses'];
        $this->total_bomberil += $result['bomberil'];
        $this->total_bomberil_intereses += $result['bomberil_intereses'];
        $this->total_bomberil_descuento_intereses += $result['bomberil_descuento_intereses'];
        $this->total_ambiental += $result['ambiental'];
        $this->total_ambiental_intereses += $result['ambiental_intereses'];
        $this->total_ambiental_descuento_intereses += $result['ambiental_descuento_intereses'];
        $this->total_alumbrado += $result['alumbrado'];
        $this->total_intereses += $result['total_intereses'];

        return $result;
    }

    private function calculate_tarifa(float $value, float $tarifa, bool $is_tasa_por_mil = true): float
    {
        if ($is_tasa_por_mil) {
            return Round::pesos($value * ($tarifa / 1000));
        } else {
            return Round::pesos($value * ($tarifa / 100));
        }
    }
}
