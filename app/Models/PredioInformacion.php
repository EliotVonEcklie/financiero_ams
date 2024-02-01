<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PredioInformacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
        'codigo_destino_economico_id',
        'direccion',
        'hectareas',
        'metros_cuadrados',
        'area_construida',
        'predio_estrato_id',
        'predio_tipo_id'
    ];

    public function predio(): BelongsTo
    {
        return $this->belongsTo(Predio::class);
    }

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
