<?php

namespace App\Jobs;

use App\Models\Predio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class RestorePredios implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 5000;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    private function dumped($table)
    {
        $path = Storage::path('restore/' . $table . '.csv');

        $handle = fopen($path, 'r');

        while (($line = fgets($handle)) !== false) {
            yield str_getcsv($line, ';');
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // load up all dumped predios

        foreach ($this->dumped('predios') as $predio) {
            Predio::updateOrCreate([
                'codigo_catastro' => $predio[0]
            ], [
                'total' => (int) $predio[1]
            ]);
        }

        $predios = Predio::lazy();

        // load up all dumped propietarios

        foreach ($this->dumped('propietarios') as $propietario) {
            $predios->where('codigo_catastro', $propietario[0])
                ->first()
                ->propietarios()->create([
                    'orden' => (int) $propietario[1],
                    'created_at' => new Carbon($propietario[2]),
                    'tipo_documento' => $propietario[3],
                    'documento' => $propietario[4],
                    'nombre_propietario' => $propietario[5]
                ]);
        }

        // load up all dumped informacion

        foreach ($this->dumped('informacion') as $info) {
            $predios->where('codigo_catastro', $info[0])
                ->first()
                ->informacions()->create([
                    'created_at' => new Carbon($info[1]),
                    'codigo_destino_economico_id' => (int) $info[2],
                    'direccion' => $info[3],
                    'hectareas' => (int) $info[4],
                    'metros_cuadrados' => (int) $info[5],
                    'area_construida' => (int) $info[6],
                    'predio_estrato_id' => (int) $info[7],
                    'predio_tipo_id' => (int) $info[8]
                ]);
        }

        // load up all dumped avaluos

        foreach ($this->dumped('avaluos') as $avaluo) {
            $predios->where('codigo_catastro', $avaluo[0])
                ->first()
                ->avaluos()->create([
                    'vigencia' => $avaluo[1],
                    'pagado' => (boolean) $avaluo[2],
                    'valor_avaluo' => (int) $avaluo[3],
                    'tasa_por_mil' => (float) $avaluo[4]
                ]);
        }
    }
}
