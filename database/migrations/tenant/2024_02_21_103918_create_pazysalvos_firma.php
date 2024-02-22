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
        if (! Schema::hasTable('firmaspdf')) {
            Schema::create('firmaspdf', function (Blueprint $table) {
                $table->id('idfirmas');
                $table->string('descripcion', 100);
                $table->string('modulo', 100);
                $table->char('estado', 1);
            });
        }

        if (! Schema::hasTable('firmaspdf_det')) {
            Schema::create('firmaspdf_det', function (Blueprint $table) {
                $table->id('iddet');
                $table->integer('idfirmas');
                $table->string('documento', 100);
                $table->string('funcionario', 100);
                $table->integer('idcargo');
                $table->string('nomcargo', 100);
                $table->integer('orden');
                $table->char('estado', 1);
                $table->string('fecha', 10);
                $table->string('titulo', 100);
            });
        }

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
        if (Schema::hasTable('firmaspdf_det')) {
            DB::table('firmaspdf_det')->where('idfirmas', 8)->delete();
        }

        if (Schema::hasTable('firmaspdf')) {
            DB::table('firmaspdf')->where('idfirmas', 8)->delete();
        }
    }
};
