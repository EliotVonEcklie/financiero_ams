<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class FacturaPredial extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    public function predio(): BelongsTo
    {
        return $this->belongsTo(Predio::class);
    }

    public function updatePagueHasta()
    {
        $vigencias = Collection::make($this->data['liquidacion']['vigencias']);

        $deuda = $vigencias->where('isSelected', true)->every(function ($vigencia) {
            return $vigencia['total_intereses'] > 0 || $vigencia['vigencia'] < now()->year;
        });

        if ($deuda) {
            $this->data['pague_hasta'] = now();
        } else {
            $this->data['pague_hasta'] = Descuento::firstDayWithoutDescuento();
        }

        $this->save();
    }
}
