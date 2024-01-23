<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Helpers\Liquidacion;
use App\Helpers\Censor;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

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

    public function estado_de_cuenta()
    {
        $pdf = Pdf::loadView('pdf.estado_de_cuenta', []);
        return $pdf->stream();
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
                'predio_tipos.nombre as predio_tipo'
            )
            ->join('historial_predios', 'predios.id', '=', 'predio_id')
            ->join('predio_tipos', 'predio_tipos.id', '=', 'predio_tipo_id')
            ->where('codigo_catastro', 'like', '%' . $query . '%')
            ->orWhere('direccion', 'like', '%' . $query . '%')
            ->orderBy('codigo_catastro', 'asc')
            ->take(50)
            ->get();

        foreach ($predios as $predio) {
            $predio->documento = Censor::str($predio->documento, -2);
            $predio->nombre_propietario = Censor::str($predio->nombre_propietario);
        }

        return $predios;
    }

    public static function show($id) {
        $predio = self::find($id);

        $liquidacion = new Liquidacion($predio->avaluos()->orderBy('vigencia', 'desc')->get());

        $latest_historial = $predio->latest_historial_predio();
        $destino_economico = $predio->latest_avaluo()->codigo_destino_economico->destino_economico === null ?
            'Código: ' + $predio->latest_avaluo()->codigo_destino_economico->codigo :
            $predio->latest_avaluo()->codigo_destino_economico->destino_economico->nombre;

        $interes_vigente = Interes::getInteresVigente();

        return [
            'id' => $predio->id,
            'codigo_catastro' => $predio->codigo_catastro,
            'total' => sprintf('%03d', $predio->total),
            'orden' => sprintf('%03d', $predio->orden),
            'valor_avaluo' => $predio->latest_avaluo()->valor_avaluo,
            'documento' => Censor::str($latest_historial->documento, -2),
            'nombre_propietario' => Censor::str($latest_historial->nombre_propietario),
            'direccion' => $latest_historial->direccion,
            'hectareas' => $latest_historial->hectareas,
            'metros_cuadrados' => $latest_historial->metros_cuadrados,
            'area_construida' => $latest_historial->area_construida,
            'predio_tipo' => $latest_historial->predio_tipo->nombre,
            'destino_economico' => $destino_economico,
            'interes_vigente' => $interes_vigente !== null ? $interes_vigente->moratorio : 0,
            'descuento_vigente' => Descuento::getDescuentoIncentivo(),
            'liquidacion' => $liquidacion->toArray()
        ];
    }
}
