<?php

namespace App\Jobs;

use App\Models\Predio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ReadPrescripciones implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 2400;

    private $tesoprescripciones;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $prescripciones = DB::table('tesoprescripciones_det')
            ->select('cedulacatastral', DB::raw('GROUP_CONCAT(vigencia) as vigencias'))
            ->join('tesoprescripciones', 'tesoprescripciones_det.id', '=', 'tesoprescripciones.id')
            ->where(DB::raw('LENGTH(cedulacatastral)'), '>=', 25)
            ->where('tesoprescripciones_det.estado', 'S')
            ->where('tesoprescripciones.estado', 'S')
            ->groupBy('cedulacatastral')
            ->orderBy('cedulacatastral')
            ->lazy();

        foreach ($prescripciones as $prescripcion) {
            $predio = Predio::firstWhere('codigo_catastro', $prescripcion->cedulacatastral);

            $predio->avaluos()
                ->whereIn('vigencia', explode(',', $prescripcion->vigencias))
                ->update(['pagado' => true]);
        }
    }
}
