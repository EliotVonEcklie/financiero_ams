<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Descuento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'es_nacional',
        'hasta',
        'porcentaje',
    ];

    public static function getDescuentoIntereses($date = null)
    {
        $date ??= now();

        // find nacional descuento
        $nacional = self::where('es_nacional', true)
            ->where('hasta', '>=', $date->year)
            ->orderBy('hasta', 'desc')
            ->first();

        return $nacional !== null ? $nacional->porcentaje : 0;
    }

    public static function getDescuentoIncentivo($date = null)
    {
        $date ??= now();

        // find descuento for month
        $incentivo = self::where('es_nacional', false)
            ->where('hasta', '>=', $date->month)
            ->orderBy('hasta', 'asc')
            ->first();

        return $incentivo !== null ? $incentivo->porcentaje : 0;
    }

    public static function firstDayWithoutDescuento()
    {
        $lastDescuento = self::where('es_nacional', false)
            ->where('hasta', '>=', now()->month)
            ->orderBy('hasta', 'asc')
            ->first();

        return $lastDescuento !== null ?
            Carbon::createFromDate(null, $lastDescuento->hasta)->lastOfMonth() : now();
    }
}
