<?php

namespace App\Jobs;

use App\Models\Predio;
use App\Models\Prescripcion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;

use Illuminate\Support\Facades\Log;

class ImportPrescripciones implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 2400;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Simular alguna tarea que tome tiempo

        // Registra algún mensaje o realiza alguna acción
        Log::info('El job ha sido ejecutado correctamente.');
        $tesoprescipciones = DB::table('tesoprescripciones')
            ->lazyById();

        foreach ($tesoprescipciones as $tesoprescripcion) {
            if (strlen($tesoprescripcion->cedulacatastral) >= 25) {
                $this->import($tesoprescripcion);
            }
        }
    }

    private function import($tesoprescripcion)
    {
        $fecha = new Carbon($tesoprescripcion->fecha);

        $predio_data = Predio::show_on($tesoprescripcion->cedulacatastral, (string) $fecha->year);

        if ($predio_data === null) {
            return;
        }

        $predio = Predio::find($predio_data['id']);

        $propietarios = $predio->propietarios()
            ->whereNot('orden', $predio_data['orden'])
            ->where('created_at', '<=', $fecha->copy()->endOfDay())
            ->select([DB::raw('distinct orden'), 'id', 'documento', 'nombre_propietario'])
            ->get()->map(function ($propietario) {
                return [
                    'orden' => $propietario->orden,
                    'id' => $propietario->id,
                    'documento' => $propietario->documento,
                    'nombre_propietario' => $propietario->nombre_propietario
                ];
            });

        $predio_data['resolucion'] = $tesoprescripcion->resolucion == '' ? null : $tesoprescripcion->resolucion;
        $predio_data['propietarios'] = $propietarios;
        $predio_data['info_liquidacion_prescrita'] = [];
        $predio_data['tesorecibocaja_id'] = $tesoprescripcion->id ?? 0;
        $predio_data['hasta'] = $fecha->copy()->endOfYear();
        //dd($predio_data);
        Prescripcion::withTrashed()->updateOrCreate([
            'id' => $tesoprescripcion->id,
        ], [
            'ip' => '127.0.0.1',
            'data' => $predio_data,
            'created_at' => $fecha->copy()->startOfDay(),
            'deleted_at' => $tesoprescripcion->estado === 'S' ? null : now()
        ]);
    }
}
