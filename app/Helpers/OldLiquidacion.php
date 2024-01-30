<?php

namespace App\Helpers;

use App\Models\Descuento;
use App\Models\Interes;
use App\Models\Predio;
use Illuminate\Support\Facades\DB;

class OldLiquidacion
{
    public static function save(array $liquidacion_array, string $user_name): int
    {
        $predio = Predio::find($liquidacion_array['predio_id']);

        $selected_vigencias = array_filter($liquidacion_array['vigencias'], function ($vigencia) {
            return $vigencia['selected'] ?? $vigencia['isSelected'] ?? false;
        });

        $total_liquidacion = array_reduce($selected_vigencias, function ($a, $v) {
            return $a + $v['total_liquidacion'];
        }, 0);
        $total_predial = array_reduce($selected_vigencias, function ($a, $v) {
            return $a + $v['predial'];
        }, 0);
        $total_bomberil = array_reduce($selected_vigencias, function ($a, $v) {
            return $a + $v['bomberil'];
        }, 0);
        $total_ambiental = array_reduce($selected_vigencias, function ($a, $v) {
            return $a + $v['ambiental'];
        }, 0);
        $total_intereses = array_reduce($selected_vigencias, function ($a, $v) {
            return $a + $v['total_intereses'];
        }, 0);
        $total_predial_intereses = array_reduce($selected_vigencias, function ($a, $v) {
            return $a + $v['predial_intereses'];
        }, 0);
        $total_bomberil_intereses = array_reduce($selected_vigencias, function ($a, $v) {
            return $a + $v['bomberil_intereses'];
        }, 0);
        $total_ambiental_intereses = array_reduce($selected_vigencias, function ($a, $v) {
            return $a + $v['ambiental_intereses'];
        }, 0);
        $total_predial_descuento = array_reduce($selected_vigencias, function ($a, $v) {
            return $a + $v['predial_descuento'];
        }, 0);
        $total_predial_descuento_intereses = array_reduce($selected_vigencias, function ($a, $v) {
            return $a + $v['predial_descuento_intereses'];
        }, 0);
        $total_bomberil_descuento_intereses = array_reduce($selected_vigencias, function ($a, $v) {
            return $a + $v['bomberil_descuento_intereses'];
        }, 0);
        $total_ambiental_descuento_intereses = array_reduce($selected_vigencias, function ($a, $v) {
            return $a + $v['ambiental_descuento_intereses'];
        }, 0);

        $tesoliquidapredial = DB::table('tesoliquidapredial')->insertGetId([
            'codigocatastral' => substr($predio->codigo_catastro, 0, 30),
            'fecha' => now(),
            'vigencia' => substr(now()->year, 0, 4),
            'tercero' => substr($predio->latest_historial_predio()->documento, 0, 30),
            'tasamora' => Interes::getInteresVigente(now())->moratorio,
            'descuento' => Descuento::getDescuentoIncentivo(),
            'tasapredial' => $predio->latest_avaluo()->tasa_por_mil,
            'totaliquida' => $total_liquidacion,
            'totalpredial' => $total_predial,
            'totalbomb' => $total_bomberil,
            'totalmedio' => $total_ambiental,
            'totalinteres' => $total_intereses,
            'intpredial' => $total_predial_intereses,
            'intbomb' => $total_bomberil_intereses,
            'intmedio' => $total_ambiental_intereses,
            'totaldescuentos' => $total_predial_descuento +
                $total_predial_descuento_intereses +
                $total_bomberil_descuento_intereses +
                $total_ambiental_descuento_intereses,
            'concepto' => substr('Años Liquidados: ' . implode(' ', array_column($selected_vigencias, 'vigencia')), 0, 200),
            'estado' => 'S',
            'ord' => sprintf('%03d', $predio->orden),
            'tot' => sprintf('%03d', $predio->total)
        ]);

        foreach ($selected_vigencias as $vigencia) {
            DB::table('tesoliquidapredial_desc')->insert([
                'id_predial' => $tesoliquidapredial,
                'cod_catastral' => substr($predio->codigo_catastro, 0, 30),
                'vigencia' => (string) $vigencia['vigencia'],
                'descuentointpredial' => $vigencia['predial_descuento_intereses'],
                'descuentointbomberil' => $vigencia['bomberil_descuento_intereses'],
                'descuentointambiental' => $vigencia['ambiental_descuento_intereses'],
                'val_alumbrado' => $vigencia['alumbrado'],
                'estado' => 'S',
                'user' => substr($user_name, 0, 50)
            ]);

            DB::table('tesoliquidapredial_det')->insert([
                'idpredial' => $tesoliquidapredial,
                'vigliquidada' => (string) $vigencia['vigencia'],
                'avaluo' => $vigencia['valor_avaluo'],
                'tasav' => $vigencia['tasa_por_mil'],
                'predial' => $vigencia['predial'],
                'intpredial' => $vigencia['predial_intereses'],
                'bomberil' => $vigencia['bomberil'],
                'intbomb' => $vigencia['bomberil_intereses'],
                'medioambiente' => $vigencia['ambiental'],
                'intmedioambiente' => $vigencia['ambiental_intereses'],
                'descuentos' => $vigencia['predial_descuento'],
                'totaliquidavig' => $vigencia['total_liquidacion'],
                'estado' => 'S'
            ]);
        }

        return $tesoliquidapredial;
    }
}
