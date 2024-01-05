<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CodigoDestinoEconomico extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo',
        'destino_economico_id'
    ];

    public function destino_economico(): BelongsTo
    {
        return $this->belongsTo(DestinoEconomico::class);
    }
}
