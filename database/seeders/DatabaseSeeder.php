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
        if (tenant() === null) {
            \App\Models\Tenant::firstOrCreate([
                'id' => 'rosalia'
            ], [
                'tenancy_db_name' => 'rosalia'
            ])->domains()->firstOrCreate([
                'domain' => 'rosalia'
            ]);

            return;
        }

        \App\Models\UnidadMonetaria::create([
            'nombre' => 'UVT'
        ]);

        \App\Models\UnidadMonetaria::create([
            'nombre' => 'SMMLV'
        ]);

        $unidad = \App\Models\UnidadMonetaria::create([
            'nombre' => 'Unidad'
        ]);

        for ($i = 1970; $i <= (int) now()->year; $i++) {
            \App\Models\VigenciaUnidadMonetaria::create([
                'vigencia' => $i,
                'unidad_monetaria_id' => $unidad->id,
                'valor' => 1
            ]);
        }

        \App\Models\PredioTipo::create([
            'nombre' => 'Rural',
            'codigo' => '00'
        ]);

        \App\Models\PredioTipo::create([
            'nombre' => 'Urbano',
            'codigo' => '01'
        ]);

        for ($i = 1; $i <= 6; $i++) {
            \App\Models\PredioEstrato::create([
                'estrato' => $i
            ]);
        }
    }
}
