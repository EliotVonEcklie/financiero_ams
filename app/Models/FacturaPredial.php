<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacturaPredial extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    public function predio(): BelongsTo
    {
        return $this->belongsTo(Predio::class);
    }
}
