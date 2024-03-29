<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estratificacion extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'vigencia',
        'predio_tipo_id',
        'destino_economico_id',
        'tarifa_id',
        'tarifa_type',
        'tasa'
    ];

    public function predio_tipo(): BelongsTo
    {
        return $this->belongsTo(PredioTipo::class);
    }

    public function destino_economico(): BelongsTo
    {
        return $this->belongsTo(DestinoEconomico::class);
    }

    public function tarifa(): MorphTo
    {
        return $this->morphTo('tarifa');
    }
}
