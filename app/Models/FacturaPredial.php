<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
