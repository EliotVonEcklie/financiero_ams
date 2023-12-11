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
use Symfony\Component\Process\Process;

class ProcessIgacFile implements ShouldQueue//, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 1500;

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
        $line_r1 = strtok($contents_r1, $separator);

        while ($line_r1 !== false) {
            $data_r1 = $this->parse_line_r1($line_r1);

            // Find or create Predio object
            $predio = Predio::firstOrCreate([
                'codigo_catastro' => $data_r1->codigo_catastro,
                'total' => $data_r1->total,
                'orden' => $data_r1->orden
            ]);

            // Find or create DestinoEconomico object

            $destino_economico = DestinoEconomico::firstOrCreate([
                'codigo' => $data_r1->destino_economico
            ]);

            // Create HistorialPredio

            HistorialPredio::firstOrCreate([
                'predio_id' => $predio->id,
                'destino_economico_id' => $destino_economico->id,
                'fecha' => $data_r1->vigencia,
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

            // Create Avaluo

            Avaluo::firstOrCreate([
                'predio_id' => $predio->id,
                'destino_economico_id' => $destino_economico->id,
                'vigencia' => $data_r1->vigencia,
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
        $line_r2 = strtok($contents_r1, $separator);

        while ($line_r2 !== true) {
            $data_r2 = $this->parse_line_r2($line_r2);

            // Find Predio
            $predio = Predio::where('codigo_catastro', $data_r2->codigo_catastro)
                ->where('total', $data_r2->total)
                ->where('orden', $data_r2->orden)
                ->firstOrFail();

            // Find and update HistorialPredio
            $historial_predio = $predio->latest_historial_predio();
            $historial_predio->estrato = $data_r2->estrato;
            $historial_predio->save();

            // Find and update Avaluo
            $avaluo = $predio->latest_avaluo();
            $avaluo->estrato = $data_r2->estrato;
            $avaluo->save();

            $line_r2 = strtok($contents_r2, $separator);
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
        $codigo_catastro = substr($line, 5, 25);
        // tipo predio
        $tipo_predio = substr($codigo_catastro, 0, 2) == '01' ? 'urbano' : 'rural';
        // orden
        $orden = (int) substr($line, 31, 3);
        // total
        $total = (int) substr($line, 34, 3);
        // nombre propietario
        $nombre_propietario = rtrim(substr($line, 37, 100));
        // tipo documento
        $tipo_documento = substr($line, 138, 1);
        // documento
        $documento = rtrim(substr($line, 139, 12));
        // direccion
        $direccion = rtrim(substr($line, 151, 100));
        // destino economico
        $destino_economico = substr($line, 252, 1);
        // area terreno (11=hectareas, 4=metros cuadrados)
        $hectareas = (int) substr($line, 253, 11);
        $metros_cuadrados = (int) substr($line, 263, 4);
        // area construida
        $area_construida = (int) substr($line, 268, 6);
        // valor avaluo
        $valor_avaluo = (int) substr($line, 274, 15);
        // vigencia (year only)
        $vigencia = date_create(substr($line, 290, 4));

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
        $codigo_catastro = substr($line, 5, 25);
        // orden
        $orden = (int) substr($line, 31, 3);
        // total
        $total = (int) substr($line, 34, 3);
        // estrato
        $estrato = (int) substr($line, 171, 1);
        
        return (object) [
            'codigo_catastro' => $codigo_catastro,
            'orden' => $orden,
            'total' => $total,
            'estrato' => $estrato
        ];
    }
}
