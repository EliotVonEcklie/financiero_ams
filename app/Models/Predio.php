<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    /**
     * Get the historial predios for the predio.
     */
    public function historial_predios(): HasMany
    {
        return $this->hasMany(HistorialPredio::class);
    }

    /**
     * Get the latest historial predio for the predio.
     */
    public function latestHistorialPredio(): HistorialPredio {
        return $this->historial_predios
            ->order_by('created_at', 'desc')
            ->take(1)
            ->get();
    }

    /**
     * Get a predio by searching a query.
     */
    public static function search(string $query) {
        $predios = Predio::join('historial_predios', 'predios.id', '=', 'historial_predios.predio_id')
            ->where('codigo_catastro', 'like', '%' . $query . '%')
            ->orWhere('documento', 'like', '%' . $query . '%')
            ->orWhere('nombre_propietario', 'like', '%' . $query . '%')
            ->orWhere('direccion', 'like', '%' . $query . '%')
            ->orderBy('codigo_catastro', 'desc')
            ->get();

        return $predios;
    }

    /**
     * Get a predio by searching a query, paginated.
     */
    public static function searchPaginated(string $query, int $page, int $amount = 100) {
        $offset = ($page - 1) * $amount;

        $predios = Predio::join('historial_predios', 'predios.id', '=', 'historial_predios.predio_id')
            ->where('codigo_catastro', 'like', '%' . $query . '%')
            ->orWhere('documento', 'like', '%' . $query . '%')
            ->orWhere('nombre_propietario', 'like', '%' . $query . '%')
            ->orWhere('direccion', 'like', '%' . $query . '%')
            ->orderBy('codigo_catastro', 'desc')
            ->skip($offset)
            ->take($amount)
            ->get();

        return $predios;
    }
}
