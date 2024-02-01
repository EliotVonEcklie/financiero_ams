<?php

namespace App\Jobs;

use App\Helpers\TranscribeCatastro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Predio;

class TranscribeCatastros implements ShouldQueue
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

    private function lines()
    {
        $path = Storage::path('data/cartera.csv');

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
        $conversions = TranscribeCatastro::transcribe(Storage::path('data/r1.txt'));

        foreach ($this->lines() as $predio) {
            $conversion = $conversions->firstWhere('old', $predio[0]);

            if (! $conversion) {
                continue;
            }

            Predio::firstOrCreate([
                'codigo_catastro' => $conversion['current']
            ])->avaluos()->updateOrCreate([
                'vigencia' => $predio[1]
            ], [
                'valor_avaluo' => $predio[2]
            ]);
        }
    }
}
