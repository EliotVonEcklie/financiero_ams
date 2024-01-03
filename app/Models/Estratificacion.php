<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estratificacion extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estratificaciones';

    public function predio_tipo(): BelongsTo
    {
        return $this->belongsTo(PredioTipo::class);
    }

    public function destino_economico(): BelongsTo
    {
        return $this->belongsTo(DestinoEconomico::class);
    }
}
