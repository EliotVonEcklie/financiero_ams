<?php

namespace App\Models;

use Illuminate\Support\Carbon;
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
            ->orderByDesc('hasta')
            ->first();

        return $nacional?->porcentaje ?? 0;
    }

    public static function getDescuentoIncentivo($date = null)
    {
        $date ??= now();

        // find descuento for month
        $incentivo = self::where('es_nacional', false)
            ->where('hasta', '>=', $date->month)
            ->orderBy('hasta')
            ->first();

        return $incentivo?->porcentaje ?? -1;
    }

    public static function lastDay(): Carbon
    {
        $lastDescuento = self::where('es_nacional', false)
            ->where('hasta', '>=', now()->month)
            ->orderBy('hasta')
            ->first();

        return $lastDescuento !== null ?
            Carbon::create(null, $lastDescuento->hasta)->endOfMonth() : Carbon::createMidnightDate();
    }
}
