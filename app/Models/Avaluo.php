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
        'destino_economico_id',
        'vigencia',
        'pagado',
        'valor_avaluo',
        'direccion',
        'hectareas',
        'metros_cuadrados',
        'area_construida',
        'tasa_por_mil',
        'estrato',
        'tipo_predio'
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
     * Get the destino economico for the historial predio.
     */
    public function destino_economico(): BelongsTo
    {
        return $this->belongsTo(DestinoEconomico::class);
    }
}
