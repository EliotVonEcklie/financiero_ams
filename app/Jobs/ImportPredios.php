<?php

namespace App\Jobs;

use App\Models\Avaluo;
use App\Models\CodigoDestinoEconomico;
use App\Models\Predio;
use App\Models\PredioTipo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImportPredios implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $predio_tipos;
    private $tesopredios;
    private $tesoprediosavaluos;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->predio_tipos = PredioTipo::lazy();
        $this->tesoprediosavaluos = DB::table('tesoprediosavaluos')->orderBy('vigencia')->lazy();
        $this->tesopredios = DB::table('tesopredios')->orderBy('vigencia')->lazy();

        $old_predios_list = '';

        foreach ($this->tesoprediosavaluos as $tesopredioavaluo) {
            if (strlen($tesopredioavaluo->codigocatastral) === 25) {
                $this->import_predio($tesopredioavaluo);
            } else {
                $old_predios_list .= $tesopredioavaluo->codigocatastral . ',' . $tesopredioavaluo->tot . ',' . $tesopredioavaluo->ord . "\n";
            }
        }

        if ($old_predios_list !== '') {
            Storage::put('old_predios/importpredios/' . now() . '.csv', $old_predios_list);
        }
    }

    public function import_predio($tesopredioavaluo)
    {
        $tesopredio = $this->tesopredios
            ->where('cedulacatastral', $tesopredioavaluo->codigocatastral)
            ->where('ord', $tesopredioavaluo->ord)
            ->where('tot', $tesopredioavaluo->tot)
            ->first();

        if ($tesopredio === null) {
            return;
        }

        $predio = Predio::firstOrCreate([
            'codigo_catastro' => $tesopredioavaluo->codigocatastral,
            'total' => $tesopredioavaluo->tot,
            'orden' => $tesopredioavaluo->ord
        ]);

        $historial_predio = $this->import_historial_predio($tesopredioavaluo, $tesopredio, $predio);
        $this->import_avaluo($tesopredioavaluo, $historial_predio);
    }

    public function import_historial_predio($tesopredioavaluo, $tesopredio, $predio)
    {
        $predio_tipo = $this->predio_tipos->where('codigo', substr($tesopredio->cedulacatastral, 0, 2))->first();

        $codigo_destino_economico = CodigoDestinoEconomico::firstOrCreate([
            'codigo' => $tesopredioavaluo->destino_economico
        ]);

        return $predio->historial_predios()->updateOrCreate([
            'fecha' => $tesopredio->vigencia . '-12-31'
        ], [
            'codigo_destino_economico_id' => $codigo_destino_economico->id,
            'tipo_documento' => $tesopredio->d,
            'documento' => $tesopredio->documento,
            'nombre_propietario' => $tesopredio->nombrepropietario,
            'direccion' => $tesopredio->direccion,
            'hectareas' => $tesopredio->ha,
            'metros_cuadrados' => $tesopredio->met2,
            'area_construida' => $tesopredio->areacon,
            'predio_tipo_id' => $predio_tipo->id
        ]);
    }

    public function import_avaluo($tesopredioavaluo, $historial_predio)
    {
        $historial_predio->predio->avaluos()->updateOrCreate([
            'vigencia' => $tesopredioavaluo->vigencia
        ], [
            'codigo_destino_economico_id' => $historial_predio->codigo_destino_economico_id,
            'pagado' => $tesopredioavaluo->pago === 'S',
            'direccion' => $historial_predio->direccion,
            'valor_avaluo' => $tesopredioavaluo->avaluo,
            'hectareas' => $historial_predio->hectareas,
            'metros_cuadrados' => $historial_predio->metros_cuadrados,
            'area_construida' => $historial_predio->area_construida,
            'predio_tipo_id' => $historial_predio->predio_tipo_id
        ]);
    }
}
