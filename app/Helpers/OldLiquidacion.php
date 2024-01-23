<?php

namespace App\Helpers;

use App\Calculations\Liquidacion;
use App\Models\Descuento;
use App\Models\Interes;
use Illuminate\Support\Facades\DB;

class OldLiquidacion
{
    public static function save(Liquidacion $liquidacion)
    {
        $tesoliquidapredial = DB::table('tesoliquidapredial')->create([
            'codigocatastral' => $liquidacion->avaluo->predio->codigo_catastro,
            'fecha' => now(),
            'vigencia' => $liquidacion->avaluo->vigencia,
            'tercero' => '',
            'tasamora' => Interes::getInteresVigente(now())->moratorio,
            'descuento' => Descuento::getDescuentoIncentivo(),
            'tasapredial' => $liquidacion->tasa_por_mil,
            'totaliquida' => $liquidacion->total,
            'totalpredial' => $liquidacion->valor_predial,
            'totalbomb' => $liquidacion->bomberil,
            'totalmedio' => $liquidacion->ambiental,
            'totalinteres' => $liquidacion->total_intereses,
            'intpredial' => $liquidacion->predial_intereses,
            'intbomb' => $liquidacion->bomberil_intereses,
            'intmedio' => $liquidacion->ambiental_intereses,
            'totaldescuentos' => $liquidacion->total_descuentos,
            'concepto' => '',
            'estado' => 'N',
            'ord' => sprintf('%03d', $liquidacion->avaluo->predio->orden),
            'tot' => sprintf('%03d', $liquidacion->avaluo->predio->total)
        ]);

        DB::table('tesoliquidapredial_desc')->create([
            'id_predial' => $tesoliquidapredial->idpredial,
            'cod_catastral' => $liquidacion->avaluo->predio->codigo_catastro,
            'vigencia' => $liquidacion->avaluo->vigencia,
            'descuentointpredial' => $liquidacion->descuento_intereses,
            'descuentointbomberil' => $liquidacion->descuento_intereses,
            'descuentointambiental' => $liquidacion->descuento_intereses,
            'val_alumbrado' => $liquidacion->alumbrado,
            'estado' => 'N',
            'user' => ''
        ]);
    }
}
