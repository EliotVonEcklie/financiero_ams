<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class FacturaPredial extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    public function predio(): BelongsTo
    {
        return $this->belongsTo(Predio::class);
    }

    public static function getPagueHasta($vigencias)
    {
        $pague_hasta = now();

        $deuda = $vigencias->where('isSelected', true)->every(function ($vigencia) {
            return $vigencia['total_intereses'] > 0 || $vigencia['vigencia'] < now()->year;
        });

        if (!$deuda) {
            $pague_hasta = Descuento::firstDayWithoutDescuento();
        }

        return $pague_hasta;
    }
}
