<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estatuto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'vigencia_desde',
        'vigencia_hasta',
        'norma_predial',
        'bomberil',
        'bomberil_predial',
        'bomberil_tarifa',
        'bomberil_tasa',
        'ambiental',
        'ambiental_predial',
        'ambiental_tarifa',
        'ambiental_tasa',
        'alumbrado',
        'alumbrado_urbano',
        'alumbrado_rural',
        'alumbrado_tarifa',
        'alumbrado_tasa',
        'recibo_caja',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
