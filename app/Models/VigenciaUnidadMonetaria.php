<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VigenciaUnidadMonetaria extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vigencia',
        'unidad_monetaria_id',
        'valor'
    ];

    public function unidad_monetaria(): BelongsTo
    {
        return $this->belongsTo(UnidadMonetaria::class);
    }
}
