<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PredioPropietario extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
        'orden',
        'tipo_documento',
        'documento',
        'nombre_propietario'
    ];

    public function predio(): BelongsTo
    {
        return $this->belongsTo(Predio::class);
    }
}
