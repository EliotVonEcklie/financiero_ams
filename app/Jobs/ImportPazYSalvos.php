<?php

namespace App\Jobs;

use App\Models\PazYSalvo;
use App\Models\Predio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ImportPazYSalvos implements ShouldQueue
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
        $tesopazysalvos = DB::table('tesopazysalvo')
            ->lazyById();

        foreach ($tesopazysalvos as $tesopazysalvo) {
            if (strlen($tesopazysalvo->codigocatastral) >= 25) {
                $this->import($tesopazysalvo);
            }
        }
    }

    private function import($tesopazysalvo)
    {
        $vigencia = strlen($tesopazysalvo->fecha) == 2
            ? '20' . $tesopazysalvo->fecha
            : substr($tesopazysalvo->fecha, 0, 4);

        $predio_data = Predio::show_on($tesopazysalvo->codigocatastral, $vigencia);

        if ($predio_data === null) {
            return;
        }

        $predio = Predio::find($predio_data['id']);

        $propietarios = $predio->propietarios()
            ->whereNot('orden', $predio_data['orden'])
            ->where('created_at', '<=', Carbon::create($vigencia)->endOfYear())
            ->get()->map(function ($propietario) {
                return [
                    'id' => $propietario->id,
                    'documento' => $propietario->documento,
                    'nombre_propietario' => $propietario->nombre_propietario
                ];
            });

        $predio_data['concepto'] = $tesopazysalvo->destino == '' ? null : $tesopazysalvo->destino;
        $predio_data['propietarios'] = $propietarios;
        $predio_data['hasta'] = Carbon::create($vigencia)->endOfYear();

        PazYSalvo::withTrashed()->updateOrCreate([
            'id' => $tesopazysalvo->id,
        ], [
            'ip' => '127.0.0.1',
            'data' => $predio_data,
            'deleted_at' => $tesopazysalvo->estado === 'S' ? null : now()
        ]);
    }
}
