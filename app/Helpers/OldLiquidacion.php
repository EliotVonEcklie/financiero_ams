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

        $tesoliquidapredial = DB::table('tesoliquidapredial')->insertGetId([
            'codigocatastral' => substr($predio->codigo_catastro, 0, 30),
            'fecha' => now(),
            'vigencia' => substr(now()->year, 0, 4),
            'tercero' => substr($predio->latest_historial_predio()->documento, 0, 30),
            'tasamora' => Interes::getInteresVigente(now())->moratorio,
            'descuento' => Descuento::getDescuentoIncentivo(),
            'tasapredial' => $predio->latest_avaluo()->tasa_por_mil,
            'totaliquida' => $liquidacion_array['total_liquidacion'],
            'totalpredial' => $liquidacion_array['total_predial'],
            'totalbomb' => $liquidacion_array['total_bomberil'],
            'totalmedio' => $liquidacion_array['total_ambiental'],
            'totalinteres' => $liquidacion_array['total_intereses'],
            'intpredial' => $liquidacion_array['total_predial_intereses'],
            'intbomb' => $liquidacion_array['total_bomberil_intereses'],
            'intmedio' => $liquidacion_array['total_ambiental_intereses'],
            'totaldescuentos' => $liquidacion_array['total_predial_descuento'] +
                $liquidacion_array['total_predial_descuento_intereses'] +
                $liquidacion_array['total_bomberil_descuento_intereses'] +
                $liquidacion_array['total_ambiental_descuento_intereses'],
            'concepto' => substr('Años Liquidados: ' . implode(' ', array_column($liquidacion_array['vigencias'], 'vigencia')), 0, 200),
            'estado' => 'S',
            'ord' => sprintf('%03d', $predio->orden),
            'tot' => sprintf('%03d', $predio->total)
        ]);

        foreach ($liquidacion_array['vigencias'] as $vigencia) {
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
