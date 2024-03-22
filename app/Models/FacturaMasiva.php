<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacturaMasiva extends Model
{
    use HasFactory, SoftDeletes;

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
