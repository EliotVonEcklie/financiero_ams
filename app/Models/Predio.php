<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Calculations\Liquidacion;

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

    public static function show($id) {
        $predio = self::find($id);

        $vigencias = [];

        foreach ($predio->avaluos as $avaluo) {
            if ($avaluo->tasa_por_mil === -1) {
                $liquidacion = null;
            } else {
                $liquidacion = (new Liquidacion($avaluo))->toArray();
            }

            $vigencia = [
                'vigencia' => $avaluo->vigencia,
                'tasa_por_mil' => $avaluo->tasa_por_mil
            ];

            array_push($vigencias, array_merge($vigencia, $liquidacion));
        }

        $latest_historial = $predio->latest_historial_predio();

        return [
            'id' => $predio->id,
            'codigo_catastro' => $predio->codigo_catastro,
            'total' => $predio->total,
            'orden' => $predio->orden,
            'documento' => $latest_historial->documento,
            'nombre_propietario' => $latest_historial->nombre_propietario,
            'direccion' => $latest_historial->direccion,
            'hectareas' => $latest_historial->hectareas,
            'metros_cuadrados' => $latest_historial->metros_cuadrados,
            'area_construida' => $latest_historial->area_construida,
            'predio_tipo' => $latest_historial->predio_tipo->nombre,
            'vigencias' => $vigencias
        ];
    }
}
