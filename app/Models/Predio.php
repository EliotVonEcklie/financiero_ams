<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Helpers\Liquidacion;
use App\Helpers\Censor;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Predio extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo_catastro',
        'propietario_principal'
    ];

    /**
     * Get the predio avaluos for the predio.
     */
    public function avaluos(): HasMany
    {
        return $this->hasMany(PredioAvaluo::class);
    }

    /**
     * Get the predio informacions for the predio.
     */
    public function informacions(): HasMany
    {
        return $this->hasMany(PredioInformacion::class);
    }

    /**
     * Get the predio propietarios for the predio.
     */
    public function propietarios(): HasMany
    {
        return $this->hasMany(PredioPropietario::class);
    }

    /**
     * Get the latest predio avaluo for the predio.
     */
    public function latest_avaluo()
    {
        return $this->avaluos()
            ->orderBy('vigencia', 'desc')
            ->first();
    }

    /**
     * Get the latest predio avaluo for the predio.
     */
    public function latest_informacion()
    {
        return $this->informacions()
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * Get the main predio propietario for the predio.
     */
    public function main_propietario(): BelongsTo
    {
        return $this->belongsTo(PredioPropietario::class, 'main_propietario_id');
    }

    public function factura_predials()
    {
        return FacturaPredial::where('data->id', $this->id)->get();
    }

    /**
     * Get a predio by searching a query.
     */
    public static function search(string|null $query, bool $sensible = true) {
        if (! $query) {
            return [];
        }

        $prediosQuery = Predio::select(
                'predios.id',
                'codigo_catastro',
                'total',
                'pp.documento',
                'pp.nombre_propietario',
                'pi.direccion',
                'pt.nombre as predio_tipo'
            )
            ->join('predio_informacions pi', 'predios.id', '=', 'pi.predio_id')
            ->join('predio_propietarios pp', 'predios.id', '=', 'pp.predio_id')
            ->join('predio_tipos pt', 'pt.id', '=', 'pi.predio_tipo_id')
            ->where('codigo_catastro', 'like', '%' . $query . '%')
            ->orWhere('pi.direccion', 'like', '%' . $query . '%');

        if (!$sensible) {
            $prediosQuery = $prediosQuery
                ->orWhere('pp.documento', 'like', '%' . $query . '%')
                ->orWhere('pp.nombre_propietario', 'like', '%' . $query . '%');
        }

        $predios = $prediosQuery->orderBy('codigo_catastro', 'asc')
            ->take(50)
            ->get();

        if ($sensible) {
            foreach ($predios as $predio) {
                $predio->documento = Censor::str($predio->documento, -2);
                $predio->nombre_propietario = Censor::str($predio->nombre_propietario);
            }
        }

        return $predios;
    }

    public static function show($id, $sensible = true) {
        $predio = self::find($id);

        $liquidacion = new Liquidacion($predio->avaluos()->orderBy('vigencia', 'desc')->get());

        $latest_historial = $predio->latest_historial_predio();
        $destino_economico = $predio->latest_avaluo()->codigo_destino_economico->destino_economico?->nombre ??
            'Código: ' . $predio->latest_avaluo()->codigo_destino_economico->codigo;

        $codigo_destino_economico = $predio->latest_avaluo()->codigo_destino_economico->codigo;

        $interes_vigente = Interes::getInteresVigente();

        $documento = $sensible ? Censor::str($latest_historial->documento, -2) : $latest_historial->documento;
        $nombre_propietario = $sensible ? Censor::str($latest_historial->nombre_propietario) : $latest_historial->nombre_propietario;

        return [
            'id' => $predio->id,
            'codigo_catastro' => $predio->codigo_catastro,
            'total' => sprintf('%03d', $predio->total),
            'orden' => sprintf('%03d', $predio->orden),
            'valor_avaluo' => $predio->latest_avaluo()->valor_avaluo,
            'documento' => $documento,
            'nombre_propietario' => $nombre_propietario,
            'direccion' => $latest_historial->direccion,
            'hectareas' => $latest_historial->hectareas,
            'metros_cuadrados' => $latest_historial->metros_cuadrados,
            'area_construida' => $latest_historial->area_construida,
            'predio_tipo' => $latest_historial->predio_tipo->nombre,
            'predio_tipo_codigo' => $sensible ? null : $latest_historial->predio_tipo->codigo,
            'destino_economico' => $destino_economico,
            'codigo_destino_economico' => $sensible ? null : $codigo_destino_economico,
            'interes_vigente' => $interes_vigente?->moratorio ?? 0,
            'descuento_vigente' => $liquidacion->descuento_incentivo,
            'liquidacion' => $liquidacion->toArray(),
            'factura_predials' => $predio->factura_predials()
        ];
    }
}
