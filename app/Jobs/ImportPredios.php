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
        $this->tesoprediosavaluos = DB::table('tesoprediosavaluos')->orderBy('vigencia')->lazy();

        foreach ($this->tesoprediosavaluos as $tesopredioavaluo) {
            if (strlen($tesopredioavaluo->codigocatastral) === 25) {
                $this->import($tesopredioavaluo);
            }
        }
    }

    public function import($tesopredioavaluo)
    {
        Predio::updateOrCreate([
            'codigo_catastro' => $tesopredioavaluo->codigocatastral
        ], [
            'total' => (! $tesopredioavaluo->tot) ? 1 : $tesopredioavaluo->tot
        ])->avaluos()->updateOrCreate([
            'vigencia' => $tesopredioavaluo->vigencia
        ], [
            'pagado' => $tesopredioavaluo->pago != 'N',
            'valor_avaluo' => $tesopredioavaluo->avaluo,
            'tasa_por_mil' => $tesopredioavaluo->tasa
        ]);
    }
}
