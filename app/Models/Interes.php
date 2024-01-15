<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Calculations\RoundPesos;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vigencia',
        'mes',
        'moratorio',
        'corriente'
    ];

    public static function diasMora($from, $to = null)
    {
        return $from->diffInDays($to ?? now());
    }

    public static function calculateMoratorio($deuda, $from, $to = null)
    {
        $to ??= now();

        $total = 0;

        for ($d = $from->copy(); $d < $to; $d->addDay()) {
            $interes = self::where('vigencia', $d->year)->where('mes', $d->month)->first();

            if ($interes !== null) {
                $total += ($interes->dailyMoratorioInteres() * $deuda) / 100;
            }
        }

        return RoundPesos::round($total);
    }

    public function dailyMoratorioInteres()
    {
        $is_leap = !($this->vigencia % 4) && ($this->vigencia % 100 || !($this->vigencia % 400));

        $days = $is_leap ? 366 : 365;

        return $this->moratorio / $days;
    }
}
