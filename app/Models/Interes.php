<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Round;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Interes extends Model
{
    use HasFactory, SoftDeletes;

    static protected $intereses;

    protected $fillable = [
        'vigencia',
        'mes',
        'moratorio',
        'corriente'
    ];

    public function dailyMoratorioInteres(): float
    {
        $is_leap = !($this->vigencia % 4) && ($this->vigencia % 100 || !($this->vigencia % 400));

        $days = $is_leap ? 366 : 365;

        return $this->moratorio / $days;
    }

    public static function diasMora(Carbon $from, Carbon|null $to = null)
    {
        return $from->diffInDays($to ?? now());
    }

    public static function getInteresVigente(Carbon $date = null, Collection $intereses = null)
    {
        $date ??= now();
        $intereses ??= self::all();

        return $intereses->where('vigencia', $date->year)->firstWhere('mes', $date->month);
    }

    public static function calculateMoratorio(float $deuda, Carbon $from, Carbon|null $to = null, Collection|null $intereses = null)
    {
        $to ??= now();
        $intereses ??= self::whereBetween('vigencia', [$from->year, $to->year])->get();

        $total = 0.0;

        $period = CarbonPeriod::create($from, '1 month', $to->subDay());

        foreach ($period as $d) {
            $interes = self::getInteresVigente($d, $intereses);

            if ($interes !== null) {
                $days = $d->year == $to->year && $d->month == $to->month
                    ? $to->day
                    : $d->copy()->endOfMonth()->day;

                $total += ($interes->dailyMoratorioInteres() * $days * $deuda) / 100;
            }
        }

        return Round::pesos($total);
    }
}
