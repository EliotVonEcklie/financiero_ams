<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\Predio;
use App\Models\DestinoEconomico;
use App\Models\Avaluo;
use App\Models\HistorialPredio;

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
    public function __construct(public string $path_r1, public string $path_r2)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Tokenize by new lines
        $separator = "\r\n";

        // Do R1
        $contents_r1 = Storage::get($this->path_r1);
        $contents_r1 = str_replace("\xEF\xBF\xBD", '?', $contents_r1); // Replace '�' for '?'
        $line_r1 = strtok($contents_r1, $separator);

        while ($line_r1 !== false) {
            $data_r1 = $this->parse_line_r1($line_r1);

            // Find or create Predio
            $predio = Predio::firstOrCreate([
                'codigo_catastro' => $data_r1->codigo_catastro,
                'total' => $data_r1->total,
                'orden' => $data_r1->orden
            ]);

            // Find or create DestinoEconomico
            $destino_economico = DestinoEconomico::firstOrCreate([
                'codigo' => $data_r1->destino_economico
            ]);

            // Update or create HistorialPredio
            HistorialPredio::updateOrCreate([
                'predio_id' => $predio->id,
                'fecha' => date_format($data_r1->vigencia, 'Y-m-d')
            ], [
                'destino_economico_id' => $destino_economico->id,
                'tipo_documento' => $data_r1->tipo_documento,
                'documento' => $data_r1->documento,
                'nombre_propietario' => $data_r1->nombre_propietario,
                'direccion' => $data_r1->direccion,
                'hectareas' => $data_r1->hectareas,
                'metros_cuadrados' => $data_r1->metros_cuadrados,
                'area_construida' => $data_r1->area_construida,
                'tasa_por_mil' => 0,
                'estrato' => 0,
                'tipo_predio' => $data_r1->tipo_predio
            ]);

            // Update or create Avaluo
            Avaluo::updateOrCreate([
                'predio_id' => $predio->id,
                'vigencia' => date_format($data_r1->vigencia, 'Y')
            ], [
                'destino_economico_id' => $destino_economico->id,
                'pagado' => false,
                'direccion' => $data_r1->direccion,
                'valor_avaluo' => $data_r1->valor_avaluo,
                'hectareas' => $data_r1->hectareas,
                'metros_cuadrados' => $data_r1->metros_cuadrados,
                'area_construida' => $data_r1->area_construida,
                'tasa_por_mil' => 0,
                'estrato' => 0,
                'tipo_predio' => $data_r1->tipo_predio
            ]);

            $line_r1 = strtok($separator);
        }

        // Done parsing, delete the file
        Storage::delete($this->path_r1);

        // Do R2
        $contents_r2 = Storage::get($this->path_r2);
        $contents_r2 = str_replace("\xEF\xBF\xBD", '?', $contents_r2); // Replace '�' for '?'
        $line_r2 = strtok($contents_r2, $separator);

        while ($line_r2 !== true) {
            $data_r2 = $this->parse_line_r2($line_r2);

            // Find Predio
            $predio = Predio::where('codigo_catastro', $data_r2->codigo_catastro)
                ->where('total', $data_r2->total)
                ->where('orden', $data_r2->orden)
                ->first();

            if ($predio === null) {
                continue;
            }

            // Find and update latest HistorialPredio
            $historial_predio = $predio->latest_historial_predio();
            $historial_predio->estrato = $data_r2->estrato;
            $historial_predio->save();

            // Find and update latest Avaluo
            $avaluo = $predio->latest_avaluo();
            $avaluo->estrato = $data_r2->estrato;
            $avaluo->save();

            $line_r2 = strtok($separator);
        }

        // Done parsing, delete the file
        Storage::delete($this->path_r2);

        // Clear memory from strtok
        strtok('', '');
    }

    /**
     * Parse a line of an 312-wide R1 IGAC file.
     */
    private function parse_line_r1(string $line): object {
        // codigo catastro
        $codigo_catastro = mb_substr($line, 5, 25);
        // tipo predio
        $tipo_predio = mb_substr($codigo_catastro, 0, 2) == '01' ? 'urbano' : 'rural';
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
        $destino_economico = mb_substr($line, 252, 1);
        // area terreno (11=hectareas, 4=metros cuadrados)
        $hectareas = (float) mb_substr($line, 253, 11);
        $metros_cuadrados = (float) mb_substr($line, 264, 4);
        // area construida
        $area_construida = (float) mb_substr($line, 268, 6);
        // valor avaluo
        $valor_avaluo = (float) mb_substr($line, 274, 15);
        // vigencia
        $vigencia = date_create_from_format('dmY', mb_substr($line, 289, 8));

        return (object) [
            'codigo_catastro' => $codigo_catastro,
            'total' => $total,
            'orden' => $orden,
            'nombre_propietario' => $nombre_propietario,
            'tipo_documento' => $tipo_documento,
            'documento' => $documento,
            'direccion' => $direccion,
            'destino_economico' => $destino_economico,
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
    private function parse_line_r2(string $line): object {
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
