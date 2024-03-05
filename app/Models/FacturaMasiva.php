<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaMasiva extends Model
{
    use HasFactory;

    protected $fillable = [
        'min_deuda',
        'vigencias',
        'rurales',
        'urbanos',
        'last_resolucion',
        'processing',
        'path',
        'user_id'
    ];
}
