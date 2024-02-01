<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Helpers\Liquidacion;
use App\Helpers\Censor;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

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
        'main_propietario_id'
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
    public function latest_avaluo(): PredioAvaluo
    {
        return $this->avaluos()
            ->orderBy('vigencia', 'desc')
            ->first();
    }

    /**
     * Get the latest predio avaluo for the predio.
     */
    public function latest_informacion(): PredioInformacion
    {
        return $this->informacions()
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * Get the main predio propietario for the predio.
     */
    public function main_propietario(): PredioPropietario
    {
        return $this->propietarios()
            ->where('orden', $this->main_propietario)
            ->first() ?? $this->propietarios()->first();
    }

    public function factura_predials(): Collection
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
                'predio_informacions.direccion',
                'predio_propietarios.documento',
                'predio_propietarios.nombre_propietario',
                'predio_tipos.nombre as predio_tipo'
            )
            ->join('predio_informacions', 'predios.id', '=', 'predio_informacions.predio_id')
            ->join('predio_propietarios', 'predios.id', '=', 'predio_propietarios.predio_id')
            ->join('predio_tipos', 'predio_tipos.id', '=', 'predio_tipo_id')
            ->where('codigo_catastro', 'like', '%' . $query . '%')
            ->orWhere('predio_informacions.direccion', 'like', '%' . $query . '%');

        if (!$sensible) {
            $prediosQuery = $prediosQuery
                ->orWhere('predio_propietarios.documento', 'like', '%' . $query . '%')
                ->orWhere('predio_propietarios.nombre_propietario', 'like', '%' . $query . '%');
        }

        $predios = $prediosQuery->groupBy(
                'predios.id',
                'codigo_catastro',
                'total',
                'predio_informacions.direccion',
                'predio_propietarios.documento',
                'predio_propietarios.nombre_propietario',
                'predio_tipos.nombre'
            )
            ->orderBy('codigo_catastro', 'asc')
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

        $liquidacion = new Liquidacion($predio);

        $main_propietario = $predio->main_propietario();
        $latest_info = $predio->latest_informacion();
        $destino_economico = $predio->latest_avaluo()->codigo_destino_economico->destino_economico?->nombre ??
            'Código: ' . $predio->latest_avaluo()->codigo_destino_economico->codigo;

        $codigo_destino_economico = $predio->latest_avaluo()->codigo_destino_economico->codigo;

        $interes_vigente = Interes::getInteresVigente();

        $documento = $sensible ? Censor::str($main_propietario->documento, -2) : $main_propietario->documento;
        $nombre_propietario = $sensible ? Censor::str($main_propietario->nombre_propietario) : $main_propietario->nombre_propietario;

        return [
            'id' => $predio->id,
            'codigo_catastro' => $predio->codigo_catastro,
            'total' => sprintf('%03d', $predio->total),
            'orden' => sprintf('%03d', $main_propietario->orden),
            'valor_avaluo' => $predio->latest_avaluo()->valor_avaluo,
            'documento' => $documento,
            'nombre_propietario' => $nombre_propietario,
            'direccion' => $latest_info->direccion,
            'hectareas' => $latest_info->hectareas,
            'metros_cuadrados' => $latest_info->metros_cuadrados,
            'area_construida' => $latest_info->area_construida,
            'predio_tipo' => $latest_info->predio_tipo->nombre,
            'predio_tipo_codigo' => $sensible ? null : $latest_info->predio_tipo->codigo,
            'destino_economico' => $destino_economico,
            'codigo_destino_economico' => $sensible ? null : $codigo_destino_economico,
            'interes_vigente' => $interes_vigente?->moratorio ?? 0,
            'descuento_vigente' => $liquidacion->descuento_incentivo,
            'liquidacion' => $liquidacion->toArray(),
            'factura_predials' => $predio->factura_predials()
        ];
    }
}
