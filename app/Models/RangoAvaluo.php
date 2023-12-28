<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RangoAvaluo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'desde',
        'hasta',
        'unidad_monetaria_id'
    ];

    public function unidad_monetaria(): BelongsTo
    {
        return $this->belongsTo(UnidadMonetaria::class);
    }
}
