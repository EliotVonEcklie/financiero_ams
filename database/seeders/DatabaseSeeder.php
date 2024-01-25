<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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

        if (Storage::disk('data')->exists('interes.json')) {
            foreach(json_decode(Storage::disk('data')->get('interes.json'))->interes as $interes) {
                \App\Models\Interes::create([
                    'vigencia' => $interes->vigencia,
                    'mes' => $interes->mes,
                    'moratorio' => $interes->moratorio,
                    'corriente' => $interes->corriente
                ]);
            }
        }
    }
}
