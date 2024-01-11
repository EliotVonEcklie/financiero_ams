<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Predio extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo_catastro',
        'total',
        'orden'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the historial predios for the predio.
     */
    public function historial_predios(): HasMany
    {
        return $this->hasMany(HistorialPredio::class);
    }

    /**
     * Get the avaluos for the predio.
     */
    public function avaluos(): HasMany
    {
        return $this->hasMany(Avaluo::class);
    }

    /**
     * Get the latest historial predio for the predio.
     */
    public function latest_historial_predio() {
        return $this->historial_predios()
            ->orderBy('fecha', 'desc')
            ->first();
    }

    /**
     * Get the latest avaluo for the predio.
     */
    public function latest_avaluo() {
        return $this->avaluos()
            ->orderBy('vigencia', 'desc')
            ->first();
    }

    /**
     * Get a predio by searching a query.
     */
    public static function search(string $query) {
        $predios = Predio::select(
                'predios.id',
                'codigo_catastro',
                'total',
                'orden',
                'documento',
                'nombre_propietario',
                'direccion',
                'predio_tipos.nombre as predio_tipo',
            )
            ->join('historial_predios', 'predios.id', '=', 'predio_id')
            ->join('predio_tipos', 'predio_tipos.id', '=', 'predio_tipo_id')
            ->where('codigo_catastro', 'like', '%' . $query . '%')
            ->orWhere('documento', 'like', '%' . $query . '%')
            ->orWhere('nombre_propietario', 'like', '%' . $query . '%')
            ->orWhere('direccion', 'like', '%' . $query . '%')
            ->orderBy('codigo_catastro', 'asc')
            ->take(50)
            ->get();

        return $predios;
    }
}
