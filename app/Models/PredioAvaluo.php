<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PredioAvaluo extends Model
{
    use HasFactory;

    protected $fillable = [
        'vigencia',
        'pagado',
        'valor_avaluo',
        'tasa_por_mil'
    ];

    public function predio(): BelongsTo
    {
        return $this->belongsTo(Predio::class);
    }
}
