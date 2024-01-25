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

    public function updatePagueHasta()
    {
        $data = $this->data;

        $vigencias = Collection::make($data['liquidacion']['vigencias']);

        $deuda = $vigencias->where('isSelected', true)->every(function ($vigencia) {
            return $vigencia['total_intereses'] > 0 || $vigencia['vigencia'] < now()->year;
        });

        if ($deuda) {
            $data['pague_hasta'] = now();
        } else {
            $data['pague_hasta'] = Descuento::firstDayWithoutDescuento();
        }

        $this->data = $data;
        $this->save();
    }
}
