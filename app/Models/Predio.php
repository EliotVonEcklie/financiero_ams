<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Helpers\Liquidacion;
use App\Helpers\Censor;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Predio extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'codigo_catastro',
        'total',
        'main_propietario_id'
    ];

    /**
     * Get the predio avaluos for the predio
     */
    public function avaluos(): HasMany
    {
        return $this->hasMany(PredioAvaluo::class);
    }

    /**
     * Get the predio informacions for the predio
     */
    public function informacions(): HasMany
    {
        return $this->hasMany(PredioInformacion::class);
    }

    /**
     * Get the predio propietarios for the predio
     */
    public function propietarios(): HasMany
    {
        return $this->hasMany(PredioPropietario::class);
    }

    /**
     * Get the latest predio avaluo for the predio
     */
    public function latest_avaluo(): PredioAvaluo|null
    {
        return $this->avaluos()
            ->orderByDesc('vigencia')
            ->first();
    }

    /**
     * Get the latest predio avaluo for the predio
     */
    public function latest_informacion(): PredioInformacion|null
    {
        return $this->informacions()
            ->orderByDesc('created_at')
            ->first();
    }

    /**
     * Get the closest avaluo for a given vigencia
     */
    public function avaluo_on(Carbon|string $vigencia): PredioAvaluo|null
    {
        return $this->avaluos()
                ->where('vigencia', '<=', Carbon::create($vigencia)->year)
                ->orderByDesc('vigencia')
                ->first()
            ?? $this->latest_avaluo();
    }

    /**
     * Get the closest informacion for a given vigencia
     */
    public function informacion_on(Carbon|string $vigencia): PredioInformacion|null
    {
        return $this->informacions()
                ->where('created_at', '<=', Carbon::create($vigencia)->endOfYear())
                ->orderByDesc('created_at')
                ->first()
            ?? $this->latest_informacion();
    }

    /**
     * Get the closest main propietario for a given vigencia
     */
    public function main_propietario_on(Carbon|string $vigencia): PredioPropietario|null
    {
        $vigencia = Carbon::create($vigencia)->endOfYear();

        return $this->propietarios()
            ->where('created_at', '<=', $vigencia)
            ->where('orden', $this->main_propietario)
            ->orderByDesc('created_at')
            ->first()
        ?? $this->propietarios()
            ->where('created_at', '<=', $vigencia)
            ->orderByDesc('created_at')
            ->orderBy('orden')
            ->first()
        ?? $this->main_propietario();
    }

    /**
     * Get the main predio propietario for the predio
     */
    public function main_propietario(): PredioPropietario|null
    {
        return $this->propietarios()
                ->where('orden', $this->main_propietario)
                ->orderByDesc('created_at')
                ->first()
            ?? $this->propietarios()
                ->orderByDesc('created_at')
                ->orderBy('orden')
                ->first();
    }

    public function factura_predials(): Collection
    {
        return FacturaPredial::where('data->id', $this->id)->get();
    }

    /**
     * Get a predio by searching a query
     */
    public static function search(string|null $query, bool $sensible = true)
    {
        if (! $query) {
            return [];
        }

        $prediosQuery = Predio::select(DB::raw('distinct predios.*'))
            ->join('predio_informacions', 'predios.id', '=', 'predio_informacions.predio_id')
            ->where('codigo_catastro', 'like', '%' . $query . '%')
            ->orWhere('direccion', 'like', '%' . $query . '%');

        if (! $sensible) {
            $prediosQuery = $prediosQuery
                ->join('predio_propietarios', 'predios.id', '=', 'predio_propietarios.predio_id')
                ->orWhere('documento', 'like', '%' . $query . '%')
                ->orWhere('nombre_propietario', 'like', '%' . $query . '%');
        }

        $predios = [];

        foreach ($prediosQuery->take(50)->get() as $predio) {
            array_push($predios, [
                'id' => $predio->id,
                'codigo_catastro' => $predio->codigo_catastro,
                'total' => sprintf('%03d', $predio->total),
                'orden' => sprintf('%03d', $predio->main_propietario()->orden),
                'direccion' => $predio->latest_informacion()->direccion,
                'documento' => $sensible
                    ? Censor::str($predio->main_propietario()->documento, -2)
                    : $predio->main_propietario()->documento,
                'nombre_propietario' => $sensible
                    ? Censor::str($predio->main_propietario()->nombre_propietario)
                    : $predio->main_propietario()->nombre_propietario,
                'predio_tipo' => $predio->latest_informacion()->predio_tipo->nombre
            ]);
        }

        return $predios;
    }

    public static function show(Predio|mixed $id, $sensible = true)
    {
        if ($id instanceof Predio) {
            $predio = $id;
        } else {
            $predio = self::find($id);
        }

        $liquidacion = new Liquidacion($predio);

        $main_propietario = $predio->main_propietario();
        $latest_info = $predio->latest_informacion();

        $codigo_destino_economico = $latest_info->codigo_destino_economico;
        $destino_economico = $codigo_destino_economico->destino_economico?->nombre ??
            'Código: ' . $codigo_destino_economico->codigo;

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
            'codigo_destino_economico' => $sensible ? null : $codigo_destino_economico->codigo,
            'interes_vigente' => $interes_vigente?->moratorio ?? 0,
            'descuento_vigente' => $liquidacion->descuento_incentivo,
            'liquidacion' => $liquidacion->toArray(),
            'factura_predials' => $predio->factura_predials()
        ];
    }

    public static function show_on(string $codigo_catastro, Carbon|mixed $vigencia): array|null
    {
        $predio = self::firstWhere('codigo_catastro', $codigo_catastro);

        if ($predio === null) {
            return null;
        }

        $propietario = $predio->main_propietario_on($vigencia);
        $avaluo = $predio->avaluo_on($vigencia);
        $info = $predio->informacion_on($vigencia);

        if ($propietario === null || $avaluo === null || $info === null) {
            return null;
        }

        return [
            'id' => $predio->id,
            'codigo_catastro' => $predio->codigo_catastro,
            'total' => sprintf('%03d', $predio->total),
            'orden' => sprintf('%03d', $propietario->orden),
            'valor_avaluo' => $avaluo->valor_avaluo,
            'documento' => $propietario->documento,
            'nombre_propietario' => $propietario->nombre_propietario,
            'direccion' => $info->direccion,
            'hectareas' => $info->hectareas,
            'metros_cuadrados' => $info->metros_cuadrados,
            'area_construida' => $info->area_construida
        ];
    }
}
