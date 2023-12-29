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

        \App\Models\Tenant::firstOrCreate([
            'id' => 'rosalia'
        ], [
            'tenancy_db_name' => 'rosalia'
        ])->domains()->firstOrCreate([
            'domain' => 'rosalia'
        ]);

        /*

        \App\Models\UnidadMonetaria::create([
            'tipo' => 'UVT'
        ]);

        \App\Models\UnidadMonetaria::create([
            'tipo' => 'SMMLV'
        ]);

        \App\Models\UnidadMonetaria::create([
            'tipo' => 'Unidad'
        ]);

        */
    }
}
