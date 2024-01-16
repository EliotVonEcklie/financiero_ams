<?php

namespace App\Jobs;

use App\Models\Avaluo;
use App\Models\Predio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ImportPredios implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $tesopredios;
    private $tesoprediosavaluos;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->tesopredios = DB::table('tesopredios')->lazy();
        $this->tesoprediosavaluos = DB::table('tesoprediosavaluos')->lazy();

        foreach ($this->tesopredios as $tesopredio) {
            $this->import_tesopredio($tesopredio);
        }
    }

    public function import_tesopredio($tesopredio)
    {
        $tesopredioavaluo = $this->tesoprediosavaluos
            ->where('codigocatastral', $tesopredio->cedulacatastral)
            ->where('ord', $tesopredio->ord)
            ->where('tot', $tesopredio->tot)
            ->all();

        $predio = Predio::firstOrCreate([
            'codigo_catastro' => $tesopredio->cedulacatastral,
            'total' => $tesopredio->tot,
            'orden' => $tesopredio->ord
        ]);

        $this->import_tesopredioavaluo($tesopredioavaluo, $predio);
    }

    public function import_tesopredioavaluo($tesopredioavaluo, $predio)
    {
        $vigencia_actual = $predio->latest_avaluo() !== null ? $predio->latest_avaluo()->vigencia : now()->year;

        if ($tesopredioavaluo->vigencia === $vigencia_actual) {
            Avaluo::update();
            return;
        }
    }
}
