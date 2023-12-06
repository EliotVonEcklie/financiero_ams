<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $destino_economico_a = \App\Models\DestinoEconomico::create([
            'codigo' => 'A',
            'nombre' => 'Habitacion'
        ]);

        $destino_economico_b = \App\Models\DestinoEconomico::create([
            'codigo' => 'B',
            'nombre' => 'Finca'
        ]);

        $predio = \App\Models\Predio::create([
            'codigo_catastro' => '009800',
            'total' => 1,
            'orden' => 1
        ]);

        $historial_predio = \App\Models\HistorialPredio::create([
            'predio_id' => $predio->id,
            'destino_economico_id' => $destino_economico_a->id,
            'fecha' => '2023-01-01',
            'tipo_documento' => 'C',
            'documento' => '112292211',
            'nombre_propietario' => 'Ines Perado',
            'direccion' => 'Radio Building #24-59',
            'hectareas' => 12,
            'metros_cuadrados' => 0,
            'area_construida' => 1,
            'tasa_por_mil' => 1.5,
            'tipo_predio' => 'rural'
        ]);

        $avaluo_predio = \App\Models\Avaluo::create([
            'predio_id' => $predio->id,
            'destino_economico_id' => $destino_economico_a->id,
            'vigencia' => '2023',
            'pagado' => true,
            'direccion' => 'Radio Building #24-59',
            'valor_avaluo' => 5000000,
            'hectareas' => 12,
            'metros_cuadrados' => 0,
            'area_construida' => 1,
            'tasa_por_mil' => 1.5,
            'tipo_predio' => 'rural'
        ]);

        $predio = \App\Models\Predio::create([
            'codigo_catastro' => '008900',
            'total' => 2,
            'orden' => 1
        ]);

        $historial_predio = \App\Models\HistorialPredio::create([
            'predio_id' => $predio->id,
            'destino_economico_id' => $destino_economico_b->id,
            'fecha' => '2023-01-01',
            'tipo_documento' => 'C',
            'documento' => '112292212',
            'nombre_propietario' => 'Armando Casas',
            'direccion' => 'Radio Building #24-60',
            'hectareas' => 12,
            'metros_cuadrados' => 0,
            'area_construida' => 1,
            'tasa_por_mil' => 1.5,
            'tipo_predio' => 'rural'
        ]);

        $avaluo_predio = \App\Models\Avaluo::create([
            'predio_id' => $predio->id,
            'destino_economico_id' => $destino_economico_b->id,
            'vigencia' => '2023',
            'pagado' => true,
            'direccion' => 'Radio Building #24-60',
            'valor_avaluo' => 5000000,
            'hectareas' => 12,
            'metros_cuadrados' => 0,
            'area_construida' => 1,
            'tasa_por_mil' => 1.5,
            'tipo_predio' => 'rural'
        ]);

        $predio = \App\Models\Predio::create([
            'codigo_catastro' => '008900',
            'total' => 2,
            'orden' => 2
        ]);

        $historial_predio = \App\Models\HistorialPredio::create([
            'predio_id' => $predio->id,
            'destino_economico_id' => $destino_economico_b->id,
            'fecha' => '2023-01-01',
            'tipo_documento' => 'C',
            'documento' => '112292213',
            'nombre_propietario' => 'Armando Puertas',
            'direccion' => 'Radio Building #24-60',
            'hectareas' => 12,
            'metros_cuadrados' => 0,
            'area_construida' => 1,
            'tasa_por_mil' => 1.5,
            'tipo_predio' => 'rural'
        ]);

        $avaluo_predio = \App\Models\Avaluo::create([
            'predio_id' => $predio->id,
            'destino_economico_id' => $destino_economico_b->id,
            'vigencia' => '2023',
            'pagado' => true,
            'direccion' => 'Radio Building #24-60',
            'valor_avaluo' => 5000000,
            'hectareas' => 12,
            'metros_cuadrados' => 0,
            'area_construida' => 1,
            'tasa_por_mil' => 1.5,
            'tipo_predio' => 'rural'
        ]);
    }
}
