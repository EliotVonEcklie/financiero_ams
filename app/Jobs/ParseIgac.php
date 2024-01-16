<?php

namespace App\Jobs;

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

class ParseIgac implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 2000;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $r1_file, public string|null $r2_file)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Do R1

        LazyCollection::make(function () {
            yield from $this->generate_lines($this->r1_file);
        })->each(function ($r1_line) {
            $r1_data = $this->parse_line_r1($r1_line);

            // Find or create Predio
            $predio = Predio::firstOrCreate([
                'codigo_catastro' => $r1_data->codigo_catastro,
                'total' => $r1_data->total,
                'orden' => $r1_data->orden
            ]);

            // Find or create CodigoDestinoEconomico
            $codigo_destino_economico = CodigoDestinoEconomico::firstOrCreate([
                'codigo' => $r1_data->codigo_destino_economico
            ]);

            $predio_tipo = PredioTipo::where('codigo', $r1_data->tipo_predio)->firstOrFail();

            // Update or create HistorialPredio
            HistorialPredio::updateOrCreate([
                'predio_id' => $predio->id,
                'fecha' => $r1_data->vigencia
            ], [
                'codigo_destino_economico_id' => $codigo_destino_economico->id,
                'tipo_documento' => $r1_data->tipo_documento,
                'documento' => $r1_data->documento,
                'nombre_propietario' => $r1_data->nombre_propietario,
                'direccion' => $r1_data->direccion,
                'hectareas' => $r1_data->hectareas,
                'metros_cuadrados' => $r1_data->metros_cuadrados,
                'area_construida' => $r1_data->area_construida,
                'predio_tipo_id' => $predio_tipo->id
            ]);

            // Update or create Avaluo
            Avaluo::updateOrCreate([
                'predio_id' => $predio->id,
                'vigencia' => $r1_data->vigencia->year
            ], [
                'codigo_destino_economico_id' => $codigo_destino_economico->id,
                'direccion' => $r1_data->direccion,
                'valor_avaluo' => $r1_data->valor_avaluo,
                'hectareas' => $r1_data->hectareas,
                'metros_cuadrados' => $r1_data->metros_cuadrados,
                'area_construida' => $r1_data->area_construida,
                'predio_tipo_id' => $predio_tipo->id
            ]);
        });

        // Done parsing, delete the file
        Storage::delete($this->r1_file);

        // Check R2

        if ($this->r2_file === null) {
            return;
        }

        // Do R2

        LazyCollection::make(function () {
            yield from $this->generate_lines($this->r2_file);
        })->each(function ($r2_line) {
            $r2_data = $this->parse_line_r2($r2_line);

            // Find Predio
            $predio = Predio::where('codigo_catastro', $r2_data->codigo_catastro)
                ->where('total', $r2_data->total)
                ->where('orden', $r2_data->orden)
                ->first();

            if ($predio === null) {
                return;
            }

            $predio_estrato = PredioEstrato::where('estrato', $r2_data->estrato)->firstOrFail();

            // Find and update latest HistorialPredio
            $historial_predio = $predio->latest_historial_predio();
            $historial_predio->predio_estrato_id = $predio_estrato->id;
            $historial_predio->save();

            // Find and update latest Avaluo
            $avaluo = $predio->latest_avaluo();
            $avaluo->predio_estrato_id = $predio_estrato->id;
            $avaluo->save();
        });
    }

    private function generate_lines(string $file)
    {
        $path = Storage::path($file);

        $handle = fopen($path, 'r');

        while (($line = fgets($handle)) !== false) {
            $line = mb_convert_encoding($line, 'UTF-8', 'Windows-1252'); // IGAC files arrive encoded in CP1252
            $line = rtrim($line, "\r\n");

            if (mb_strlen($line) !== 312) {
                Log::warning('IGAC line is not 312 characters long!: (' . mb_strlen($line) . ') ' . $line);
                continue;
            }

            yield $line;
        }
    }

    /**
     * Parse a line of an 312-wide R1 IGAC file.
     */
    private function parse_line_r1(string $line): object
    {
        // codigo catastro
        $codigo_catastro = mb_substr($line, 5, 25);
        // tipo predio
        $tipo_predio = mb_substr($codigo_catastro, 0, 2);
        // orden
        $orden = (int) mb_substr($line, 31, 3);
        // total
        $total = (int) mb_substr($line, 34, 3);
        // nombre propietario
        $nombre_propietario = rtrim(mb_substr($line, 37, 100));
        // tipo documento
        $tipo_documento = mb_substr($line, 138, 1);
        // documento
        $documento = rtrim(mb_substr($line, 139, 12));
        // direccion
        $direccion = rtrim(mb_substr($line, 151, 100));
        // destino economico
        $codigo_destino_economico = mb_substr($line, 252, 1);
        // area terreno (11=hectareas, 4=metros cuadrados)
        $hectareas = (float) mb_substr($line, 253, 11);
        $metros_cuadrados = (float) mb_substr($line, 264, 4);
        // area construida
        $area_construida = (float) mb_substr($line, 268, 6);
        // valor avaluo
        $valor_avaluo = (float) mb_substr($line, 274, 15);
        // vigencia
        $vigencia = Carbon::createFromFormat('dmY', mb_substr($line, 289, 8))->startOfDay();

        return (object) [
            'codigo_catastro' => $codigo_catastro,
            'total' => $total,
            'orden' => $orden,
            'nombre_propietario' => $nombre_propietario,
            'tipo_documento' => $tipo_documento,
            'documento' => $documento,
            'direccion' => $direccion,
            'codigo_destino_economico' => $codigo_destino_economico,
            'hectareas' => $hectareas,
            'metros_cuadrados' => $metros_cuadrados,
            'area_construida' => $area_construida,
            'valor_avaluo' => $valor_avaluo,
            'vigencia' => $vigencia,
            'tipo_predio' => $tipo_predio
        ];
    }

    /**
     * Parse a line of an 312-wide R2 IGAC file.
     */
    private function parse_line_r2(string $line): object
    {
        // codigo catastro
        $codigo_catastro = mb_substr($line, 5, 25);
        // orden
        $orden = (int) mb_substr($line, 31, 3);
        // total
        $total = (int) mb_substr($line, 34, 3);
        // estrato
        $estrato = (int) mb_substr($line, 171, 1);

        return (object) [
            'codigo_catastro' => $codigo_catastro,
            'orden' => $orden,
            'total' => $total,
            'estrato' => $estrato
        ];
    }
}
