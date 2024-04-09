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

class ProcessResIgac implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $predio_tipos;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 2400;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $res_file)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->predio_tipos = PredioTipo::all();

        // Do IGAC_RES File

        LazyCollection::make(function () {
            yield from $this->generate_lines($this->res_file);
        })->each(function ($res_line) {
            $res_data = $this->parse_line($res_line);

            if ($res_data->cancela) {
                $this->cancel_predio($res_data);
            } else if ($res_data->inscribe) {
                $this->inscribe_predio($res_data);
            } else {
                Log::warning('Invalid IGAC_RES line, does not cancel nor inscribe: ' . $res_line);
                return;
            }
        });

        // Done parsing, delete the file
        Storage::delete($this->res_file);
    }

    private function generate_lines(string $file)
    {
        $path = Storage::path($file);

        $handle = fopen($path, 'r');

        while (($line = fgets($handle)) !== false) {
            $line = mb_convert_encoding($line, 'UTF-8', 'Windows-1252'); // IGAC_RES files arrive encoded in CP1252
            $line = rtrim($line, "\n\r");

            if (mb_strlen($line) !== 428) {
                Log::warning('Invalid IGAC_RES line, not 428 characters long: (' . mb_strlen($line) . ') ' . $line);
                continue;
            }

            yield $line;
        }
    }

    private function cancel_predio($res_data)
    {
        // Find or create Predio
        $predio = Predio::where('codigo_catastro', $res_data->codigo_catastro)->first();

        if ($predio !== null) {
            $predio->update([
                'cancelado' => true
            ]);
        }
    }

    private function inscribe_predio($res_data)
    {
        // Update or create Predio
        $predio = Predio::updateOrCreate([
            'codigo_catastro' => $res_data->codigo_catastro
        ], [
            'total' => $res_data->total,
            'cancelado' => false
        ]);

        if ($predio === null) {
            return;
        }

        $predio->propietarios()->updateOrCreate([
            'orden' => $res_data->orden,
            'created_at' => $res_data->vigencia
        ], [
            'nombre_propietario' => $res_data->nombre_propietario,
            'tipo_documento' => $res_data->tipo_documento,
            'documento' => $res_data->documento
        ]);

        if ($predio->informacions()->firstWhere('created_at', $res_data->vigencia) === null) {
            // Find or create CodigoDestinoEconomico
            $codigo_destino_economico = CodigoDestinoEconomico::firstOrCreate([
                'codigo' => $res_data->codigo_destino_economico
            ]);

            $predio_tipo = $this->predio_tipos->firstWhere('codigo', $res_data->tipo_predio);
            $predio_tipo ??= $this->predio_tipos->find(2); // Default to Urbano (2)

            // Create Predio Informacion
            $predio->informacions()->create([
                'created_at' => $res_data->vigencia,
                'direccion' => $res_data->direccion,
                'hectareas' => $res_data->hectareas,
                'metros_cuadrados' => $res_data->metros_cuadrados,
                'area_construida' => $res_data->area_construida,
                'codigo_destino_economico_id' => $codigo_destino_economico->id,
                'predio_tipo_id' => $predio_tipo->id
            ]);
        }

        if ($predio->avaluos()->firstWhere('vigencia', $res_data->vigencia->year) === null) {
            // Create Predio Avaluo
            $predio->avaluos()->create([
                'vigencia' => $res_data->vigencia->year,
                'valor_avaluo' => $res_data->valor_avaluo
            ]);
        }
    }

    private function parse_line_header(string $line): object
    {
        // resolucion
        $resolucion = mb_substr($line, 5, 13);
        // radicacion
        $radicacion = mb_substr($line, 11, 10);
        // tipo tramite
        $tipo_tramite = mb_substr($line, 21, 1);
        // clase mutacion
        $clase_mutacion = mb_substr($line, 22, 1);
        // codigo_catastro
        $codigo_catastro = mb_substr($line, 36, 25);
        // tipo predio
        $tipo_predio = mb_substr($codigo_catastro, 0, 2);
        // cancela_inscribe
        $cancela_inscribe = mb_substr($line, 61, 1);
        // convert to booleans
        $cancela = $cancela_inscribe === 'C';
        $inscribe = $cancela_inscribe === 'I';
        // tipo registro
        $tipo_registro = (int) mb_substr($line, 62, 1);
        // orden
        $orden = (int) mb_substr($line, 63, 3);
        // total
        $total = (int) mb_substr($line, 66, 3);

        return (object) [
            'resoluccion' => $resolucion,
            'radicacion' => $radicacion,
            'tipo_tramite' => $tipo_tramite,
            'clase_mutacion' => $clase_mutacion,
            'codigo_catastro' => $codigo_catastro,
            'tipo_predio' => $tipo_predio,
            'cancela_inscribe' => $cancela_inscribe,
            'cancela' => $cancela,
            'inscribe' => $inscribe,
            'tipo_registro' => $tipo_registro,
            'orden' => $orden,
            'total' => $total
        ];
    }

    /**
     * Parse a line of an 428-wide Registro Tipo 1 IGAC_RES file.
     */
    private function parse_line_r1(string $line, $header): object
    {
        // nombre propietario
        $nombre_propietario = rtrim(mb_substr($line, 69, 100));
        // tipo documento
        $tipo_documento = mb_substr($line, 170, 1);
        // documento
        $documento = rtrim(mb_substr($line, 171, 12));
        // direccion
        $direccion = rtrim(mb_substr($line, 183, 100));
        // destino economico
        $codigo_destino_economico = mb_substr($line, 284, 1);
        // area terreno (11=hectareas, 4=metros cuadrados)
        $hectareas = (float) mb_substr($line, 285, 11);
        $metros_cuadrados = (float) mb_substr($line, 296, 4);
        // area construida
        $area_construida = (float) mb_substr($line, 300, 6);
        // valor avaluo
        $valor_avaluo = (float) mb_substr($line, 306, 15);
        // vigencia
        $vigencia = $header->cancela
            ? Carbon::createFromFormat('dmY', mb_substr($line, 321, 8))
            : Carbon::create((int) mb_substr($line, 325, 4), null, null);

        return (object) [
            'nombre_propietario' => $nombre_propietario,
            'tipo_documento' => $tipo_documento,
            'documento' => $documento,
            'direccion' => $direccion,
            'codigo_destino_economico' => $codigo_destino_economico,
            'hectareas' => $hectareas,
            'metros_cuadrados' => $metros_cuadrados,
            'area_construida' => $area_construida,
            'valor_avaluo' => $valor_avaluo,
            'vigencia' => $vigencia
        ];
    }

    /**
     * Parse a line of an 428-wide Registro Tipo 2 IGAC_RES file.
     */
    private function parse_line_r2(string $line): object
    {
        // codigo catastro anterior
        $codigo_catastro_ant = mb_substr($line, 413, 15);

        return (object) [
            'codigo_catastro_ant' => $codigo_catastro_ant
        ];
    }

    /**
     * Parse a line of an 428-wide Registro Tipo 3 IGAC_RES file.
     */
    private function parse_line_r3(string $line): object
    {
        // decretos
        $decretos = rtrim(mb_substr($line, 69, 70));
        // motivacion
        $motivacion = rtrim(mb_substr($line, 139, 256));
        // codigo catastro anterior
        $codigo_catastro_ant = mb_substr($line, 395, 15);

        return (object) [
            'decretos' => $decretos,
            'motivacion' => $motivacion,
            'codigo_catastro_ant' => $codigo_catastro_ant
        ];
    }

    private function parse_line(string $line): object
    {
        $header = $this->parse_line_header($line);

        $parsed = [];

        switch ($header->tipo_registro) {
            case 1:
                $parsed = $this->parse_line_r1($line, $header);
            case 2:
            case 3:
            default:
                break;
        }

        return (object) array_merge(
            (array) $header,
            (array) $parsed
        );
    }
}
