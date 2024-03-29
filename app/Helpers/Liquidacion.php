<?php

namespace App\Helpers;

use App\Models\Descuento;
use App\Models\Estatuto;
use App\Models\Interes;
use App\Models\Predio;
use App\Models\PredioAvaluo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Liquidacion
{
    private Predio $predio;
    private Collection $estatutos;
    private Collection $avaluos;
    private Collection $intereses;

    public Collection $results;
    public bool $has_deuda = false;
    public int $descuento_incentivo = 0;
    public int $descuento_intereses = 0;
    public float $total_liquidacion = 0;
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

    public function __construct($descuento = true)
    {
        $this->estatutos = Estatuto::all();
        $this->descuento_incentivo = $descuento ? Descuento::getDescuentoIncentivo() : -1;
        $this->descuento_intereses = Descuento::getDescuentoIntereses();
        $this->intereses = Interes::all();
    }

    public function liquidar(Predio $predio, array $vigencias = null, $now = null)
    {
        $this->total_liquidacion = 0;
        $this->total_predial = 0;
        $this->total_predial_descuento = 0;
        $this->total_predial_intereses = 0;
        $this->total_predial_descuento_intereses = 0;
        $this->total_bomberil = 0;
        $this->total_bomberil_intereses = 0;
        $this->total_bomberil_descuento_intereses = 0;
        $this->total_ambiental = 0;
        $this->total_ambiental_intereses = 0;
        $this->total_ambiental_descuento_intereses = 0;
        $this->total_alumbrado = 0;
        $this->total_intereses = 0;

        $this->predio = $predio;

        $vigencias ??= $this->predio->avaluos()->pluck('vigencia');

        $intereses = $this->intereses->whereIn('vigencia', $vigencias);

        $this->avaluos = $this->predio->avaluos()
            ->whereIn('vigencia', $vigencias)
            ->orderBy('vigencia')
            ->get();

        $this->has_deuda = $this->avaluos
            ->where('vigencia', '<>', now()->year)
            ->where('pagado', false)
            ->isNotEmpty();

        $this->results = new Collection();

        foreach ($this->avaluos as $avaluo) {
            if (($result = $this->liquidar_avaluo($avaluo, $intereses, $now)) !== null) {
                $this->results->push($result);
            }
        }
    }

    public function toArray() : array
    {
        return [
            'vigencias' => $this->results->sortByDesc('vigencia')->values()->all(),
            'predio_id' => $this->predio->id,
            'codigo_catastro' => $this->predio->codigo_catastro,
            'total_liquidacion' => $this->total_liquidacion,
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

    private function liquidacion_anterior($result, $current_avaluo): array|null
    {
        $avaluo = $this->predio->avaluos()
            ->whereNot('tasa_por_mil', -1.0)
            ->firstWhere('vigencia', $current_avaluo->vigencia - 1);

        if ($avaluo !== null) {
            $liquidacion = [
                'vigencia' => $avaluo->vigencia,
                'predial' => $this->calculate_tarifa(
                    $avaluo->valor_avaluo,
                    $avaluo->tasa_por_mil
                )
            ];

            $liquidacion_anterior = $this->liquidacion_anterior($result, $avaluo);

            if ($liquidacion_anterior !== null) {
                $predial_anterior = $liquidacion_anterior['predial'];
                $predial_anterior_doble = $predial_anterior * 2;
                $info = $this->predio->informacion_on($avaluo->vigencia);
                $info_anterior = $this->predio->informacion_on($liquidacion_anterior['vigencia']);

                $has_changed = $info_anterior === null ||
                    Carbon::create($avaluo->vigencia) != $info->created_at ||
                    Carbon::create($liquidacion_anterior['vigencia']) != $info_anterior->created_at ||
                    ($info_anterior->area_construida == 0 && $info->area_construida > 0);

                $liquidacion['predial'] = (! $has_changed) && ($liquidacion['predial'] > $predial_anterior_doble)
                    ? $predial_anterior + $this->calculate_tarifa(
                        $predial_anterior,
                        $result['estatuto']->norma_predial_tasa,
                        false
                    )
                    : $liquidacion['predial'];
            }

            return $liquidacion;
        } else {
            return null;
        }
    }

    private function liquidar_avaluo(PredioAvaluo $avaluo, Collection $intereses, $now)
    {
        if ($avaluo->pagado) {
            return null;
        }

        $result = [
            'vigencia' => $avaluo->vigencia,
            'avaluo_id' => $avaluo->id,
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

        $result['valor_avaluo'] = $avaluo->valor_avaluo;
        $result['tasa_por_mil'] = $avaluo->tasa_por_mil;

        if ($result['estatuto'] === null || $result['tasa_por_mil'] === -1.0) {
            return $result;
        }

        if ($result['vigencia'] == now()->year) {
            if ((! $result['estatuto']->descuento_incentivo_deuda) && $this->has_deuda) {
                $apply_descuento = -1;
            } else {
                $apply_descuento = $this->descuento_incentivo >= 0 ? 0 : 1;
            }
        } else {
            $apply_descuento = 1;
        }

        $result['predial'] = $this->calculate_tarifa($result['valor_avaluo'], $result['tasa_por_mil']);

        $info = $this->predio->informacion_on($avaluo->vigencia);

        if ($result['estatuto']->norma_predial) {
            $liquidacion_anterior = $this->results
                ->where('tasa_por_mil', '<>', -1.0)
                ->firstWhere('vigencia', $avaluo->vigencia - 1)
            ?? $this->liquidacion_anterior($result, $avaluo);

            if ($liquidacion_anterior !== null) {
                $predial_anterior = $liquidacion_anterior['predial'];
                $predial_anterior_doble = $predial_anterior * 2;
                $info_anterior = $this->predio->informacion_on($liquidacion_anterior['vigencia']);

                $has_changed = $info_anterior === null ||
                    Carbon::create($avaluo->vigencia) != $info->created_at ||
                    Carbon::create($liquidacion_anterior['vigencia']) != $info_anterior->created_at ||
                    ($info_anterior->area_construida == 0 && $info->area_construida > 0);

                $result['predial'] = (! $has_changed) && ($result['predial'] > $predial_anterior_doble)
                    ? $predial_anterior + $this->calculate_tarifa(
                        $predial_anterior,
                        $result['estatuto']->norma_predial_tasa,
                        false
                    )
                    : $result['predial'];
            }
        }

        $result['predial'] = $result['predial'] > $result['estatuto']->min_predial
            ? $result['predial'] : $result['estatuto']->min_predial;

        if ($apply_descuento == 0) {
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
            if ($result['estatuto']->alumbrado_rural && $info->get_predio_tipo() === 1) {
                $result['alumbrado'] = $this->calculate_tarifa(
                    $result['valor_avaluo'],
                    $result['estatuto']->alumbrado_tasa,
                    $result['estatuto']->alumbrado_tarifa
                );
            } else if ($result['estatuto']->alumbrado_urbano && $info->get_predio_tipo() === 2) {
                $result['alumbrado'] = $this->calculate_tarifa(
                    $result['valor_avaluo'],
                    $result['estatuto']->alumbrado_tasa,
                    $result['estatuto']->alumbrado_tarifa
                );
            }
        }

        $result['total_liquidacion'] = Round::pesos(
            $result['predial'] +
            $result['bomberil'] +
            $result['ambiental'] +
            $result['alumbrado'] +
            $result['estatuto']->recibo_caja
        );

        if ($apply_descuento == 1) {
            $from = Carbon::create($result['vigencia']);

            $result['dias_mora'] = Interes::diasMora($from, $now);

            $result['predial_intereses'] = Interes::calculateMoratorio($result['predial'], $from, $now, $intereses);
            $result['predial_descuento_intereses'] = $this->calculate_tarifa(
                $result['predial_intereses'],
                $this->descuento_intereses,
                false
            );

            $result['bomberil_intereses'] = Interes::calculateMoratorio($result['bomberil'], $from, $now, $intereses);
            $result['bomberil_descuento_intereses'] = $this->calculate_tarifa(
                $result['bomberil_intereses'],
                $this->descuento_intereses,
                false
            );

            $result['ambiental_intereses'] = Interes::calculateMoratorio($result['ambiental'], $from, $now, $intereses);
            $result['ambiental_descuento_intereses'] = $this->calculate_tarifa(
                $result['ambiental_intereses'],
                $this->descuento_intereses,
                false
            );

            $result['descuento_intereses'] = Round::pesos(
                $result['predial_descuento_intereses'] +
                $result['bomberil_descuento_intereses'] +
                $result['ambiental_descuento_intereses']
            );

            $result['total_intereses'] = Round::pesos((
                    $result['predial_intereses'] +
                    $result['bomberil_intereses'] +
                    $result['ambiental_intereses']
                ) - $result['descuento_intereses']
            );

            $result['total_liquidacion'] += $result['total_intereses'];
        }

        $result['estatuto'] = $result['estatuto']->only(
            'nombre', 'norma_predial', 'bomberil', 'ambiental', 'alumbrado', 'recibo_caja'
        );

        $this->total_liquidacion += $result['total_liquidacion'];
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

    private static function calculate_tarifa(float $value, float $tarifa, bool $is_tasa_por_mil = true): float
    {
        return Round::pesos($value * $tarifa * ($is_tasa_por_mil ? 0.001 : 0.01));
    }
}
