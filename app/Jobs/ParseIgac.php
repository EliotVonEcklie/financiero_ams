<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
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
    public function __construct(public string $r1_file, public string|null $r2_file)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $predio_tipos = PredioTipo::all();

        // Do R1

        LazyCollection::make(function () {
            yield from $this->generate_lines($this->r1_file);
        })->each(function ($r1_line) use ($predio_tipos) {
            $r1_data = $this->parse_line_r1($r1_line);

            // Find or create Predio
            $predio = Predio::firstOrCreate([
                'codigo_catastro' => $r1_data->codigo_catastro,
                'total' => $r1_data->total
            ]);

            $predio->propietarios()->updateOrCreate([
                'orden' => $r1_data->orden,
                'created_at' => $r1_data->vigencia
            ], [
                'nombre' => $r1_data->nombre_propietario,
                'tipo_documento' => $r1_data->tipo_documento,
                'documento' => $r1_data->documento
            ]);

            if (! $predio->informacions()->where('created_at', $r1_data->vigencia)->first()) {
                // Find or create CodigoDestinoEconomico
                $codigo_destino_economico = CodigoDestinoEconomico::firstOrCreate([
                    'codigo' => $r1_data->codigo_destino_economico
                ]);

                $predio_tipo = $predio_tipos->where('codigo', $r1_data->tipo_predio)->firstOrFail();

                // Update or create Predio Informacion
                $informacion = $predio->informacions()->create([
                    'created_at' => $r1_data->vigencia
                ], [
                    'direccion' => $r1_data->direccion,
                    'hectareas' => $r1_data->hectareas,
                    'metros_cuadrados' => $r1_data->metros_cuadrados,
                    'area_construida' => $r1_data->area_construida
                ]);

                $informacion->codigo_destino_economico()->associate($codigo_destino_economico);
                $informacion->predio_tipo()->associate($predio_tipo);
                $informacion->save();
            }

            if (! $predio->avaluos()->where('vigencia', $r1_data->vigencia->year)->first()) {
                // Update or create Predio Avaluo
                $predio->avaluos()->updateOrCreate([
                    'vigencia' => $r1_data->vigencia->year
                ], [
                    'valor_avaluo' => $r1_data->valor_avaluo
                ]);
            }
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
                ->first();

            if ($predio === null) {
                return;
            }

            $predio_estrato = PredioEstrato::where('estrato', $r2_data->estrato)->firstOrFail();

            // Find and update latest informacion
            $predio->latest_informacion()
                ->predio_estrato()
                ->associate($predio_estrato);
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
        // total
        $total = (int) mb_substr($line, 34, 3);
        // estrato
        $estrato = (int) mb_substr($line, 171, 1);

        return (object) [
            'codigo_catastro' => $codigo_catastro,
            'total' => $total,
            'estrato' => $estrato
        ];
    }
}
