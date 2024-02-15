<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PazYSalvo extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];
}
