<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predio extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tesopredios';

    /**
     * Indicates if the model's ID is not auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedulacatastral',
        'ord',
        'tot',
        'e',
        'd',
        'documento',
        'nombrepropietario',
        'direccion',
        'ha',
        'met2',
        'areacon',
        'avaluo',
        'vigencia',
        'estado',
        'tipopredio',
        'clasifica',
        'estratos'
    ];
}
