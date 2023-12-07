<?php

namespace App\Http\Controllers;

use App\Models\Predio;
use App\Models\DestinoEconomico;
use App\Models\Avaluo;
use App\Models\HistorialPredio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\json_decode;

class IgacFileParserController extends Controller
{
    public function store(Request $request) {
        if (!$request->hasFile('igac') || !$request->igac->isValid()) {
            return redirect(route('admin.test_igac'));
        }

        // Store the file while we process it.
        $path = $request->igac->store('igac');

        // Read the stored file.
        $contents = Storage::get($path);

        // Tokenize by new lines.
        $separator = "\r\n";
        $line = strtok($contents, $separator);
        $data_array = array();

        while ($line !== false) {
            $data = $this->parse_line_r1($line);
            array_push($data_array, $data);

            // Find or create Predio object.
            $predio = Predio::firstOrCreate([
                'codigo_catastro' => $data->codigo_catastro,
                'total' => $data->total,
                'orden' => $data->orden
            ]);

            // Find or create DestinoEconomico object.

            $destino_economico = DestinoEconomico::firstOrCreate([
                'codigo' => $data->destino_economico
            ]);

            $line = strtok($separator);
        }

        // Clear memory from strtok.
        strtok('', '');

        // Done parsing, delete the file.
        Storage::delete($path);

        return view('app.test_igac')->with('lines', $data_array);
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
        $hectareas = (int) substr($line, 138, 11);
        $metros_cuadrados = (int) substr($line, 149, 4);
        // area construida
        $area_construida = (int) substr($line, 268, 6);
        // avaluo
        $avaluo = (int) substr($line, 274, 15);
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
            'avaluo' => $avaluo,
            'vigencia' => $vigencia->format('Y'),
            'tipo_predio' => $tipo_predio
        ];
    }

    public function create() {
        return view('app.test_igac');
    }
}
