<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avaluo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'predio_id',
        'codigo_destino_economico_id',
        'vigencia',
        'pagado',
        'valor_avaluo',
        'direccion',
        'hectareas',
        'metros_cuadrados',
        'area_construida',
        'tasa_por_mil',
        'predio_estrato_id',
        'predio_tipo_id'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the predio for the historial predio.
     */
    public function predio(): BelongsTo
    {
        return $this->belongsTo(Predio::class);
    }

    /**
     * Get the codigo destino economico for the historial predio.
     */
    public function codigo_destino_economico(): BelongsTo
    {
        return $this->belongsTo(CodigoDestinoEconomico::class);
    }

    public function predio_estrato(): BelongsTo
    {
        return $this->belongsTo(PredioEstrato::class);
    }

    public function predio_tipo(): BelongsTo
    {
        return $this->belongsTo(PredioTipo::class);
    }
}
