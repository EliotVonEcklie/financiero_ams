<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('firmaspdf')->insert([
            'idfirmas' => 8,
            'descripcion' => 'PAZ Y SALVO PREDIAL',
            'modulo' => 'TESORERIA',
            'estado' => 'S'
        ]);

        DB::table('firmaspdf_det')->insert([
            'idfirmas' => 8,
            'documento' => '',
            'funcionario' => '',
            'idcargo' => 0,
            'nomcargo' => '',
            'orden' => 1,
            'estado' => 'S',
            'fecha' => now()->format('Y-m-d'),
            'titulo' => ''
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('firmaspdf_det')->where('idfirmas', 8)->delete();
        DB::table('firmaspdf')->where('idfirmas', 8)->delete();
    }
};
