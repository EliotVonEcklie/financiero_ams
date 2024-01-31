<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PredioInformacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'direccion',
        'area',
        'estrato',
        'uso_suelo',
        'tipo_suelo',
        'barrio',
        'comuna',
        'latitud',
        'longitud'
    ];

    public function predio(): BelongsTo
    {
        return $this->belongsTo(Predio::class);
    }
}
