<?php

namespace App\Jobs;

use App\Models\Predio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ImportPredios implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 2400;

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
        $this->tesoprediosavaluos = DB::table('tesoprediosavaluos')
            ->select('codigocatastral', 'tot', 'vigencia', 'pago', 'avaluo', 'tasa')
            ->orderBy('vigencia')
            ->get();

        foreach ($this->tesoprediosavaluos as $tesopredioavaluo) {
            if (strlen($tesopredioavaluo->codigocatastral) >= 25) {
                $this->import($tesopredioavaluo);
            }
        }
    }

    private function import($tesopredioavaluo)
    {
        Predio::updateOrCreate([
            'codigo_catastro' => substr($tesopredioavaluo->codigocatastral, 0, 30)
        ], [
            'total' => (int) (($tesopredioavaluo->tot == '') ? 1 : $tesopredioavaluo->tot)
        ])->avaluos()->updateOrCreate([
            'vigencia' => (int) substr($tesopredioavaluo->vigencia, 0, 4)
        ], [
            'pagado' => $tesopredioavaluo->pago != 'N',
            'valor_avaluo' => (int) $tesopredioavaluo->avaluo,
            'tasa_por_mil' => (int) $tesopredioavaluo->tasa
        ]);
    }
}
