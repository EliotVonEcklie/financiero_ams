<?php

namespace App\Jobs;

use App\Helpers\TranscribeCatastro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Predio;
use App\Models\CodigoDestinoEconomico;
use App\Models\Avaluo;
use App\Models\HistorialPredio;
use App\Models\PredioEstrato;
use App\Models\PredioTipo;

class ParseIgac implements ShouldQueue
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
    public function __construct(public string $r1_file)
    {}

    private function lines()
    {
        $path = storage_path('app/data/cartera.csv');

        $handle = fopen($path, 'r');

        while (($line = fgets($handle)) !== false) {
            yield str_getcsv($line);
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $conversions = TranscribeCatastro::transcribe($this->r1_file);

        foreach ($this->lines() as $predio) {
            $conversion = $conversions->firstWhere('old', $predio[2]);
            Predio::firstOrCreate();
        }
    }
}
