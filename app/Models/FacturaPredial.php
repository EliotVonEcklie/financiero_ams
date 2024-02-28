<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\Facades\DNS1DFacade;

class FacturaPredial extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    public static function getPagueHasta($vigencias): \Illuminate\Support\Carbon
    {
        $pague_hasta = now();

        $deuda = $vigencias->filter(function ($v) {
            return $v['selected'] ?? $v['isSelected'] ?? false;
        })
        ->contains(function ($vigencia) {
            return $vigencia['total_intereses'] > 0 || $vigencia['vigencia'] < now()->year;
        });

        if (! $deuda) {
            $pague_hasta = Descuento::lastDay();
        }

        return $pague_hasta;
    }

    public static function generateBarcode($id, $total_liquidacion, $pague_hasta)
    {
        $codigo_barras = DB::table('codigosbarras')
            ->where('estado', 'S')
            ->where('tipo', '01')
            ->first(['codigo', 'codini']);

        $barcode = chr(241) . $codigo_barras->codini . $codigo_barras->codigo . '802001' .
            sprintf('%07d', $id) . '111005001' .
            chr(241) . '3900' . sprintf('%010d', $total_liquidacion) .
            chr(241) . '96' . (new Carbon($pague_hasta))->format('Ymd');

        $barcode_human = '(' . $codigo_barras->codini . ')' . $codigo_barras->codigo . '(8020)01' .
            sprintf('%07d', $id) . '111005001' .
            '(3900)' . sprintf('%010d', $total_liquidacion) .
            '(96)' . (new Carbon($pague_hasta))->format('Ymd');

        return [
            'img' => DNS1DFacade::getBarcodePNG($barcode, 'C128'),
            'human' => $barcode_human
        ];
    }
}
