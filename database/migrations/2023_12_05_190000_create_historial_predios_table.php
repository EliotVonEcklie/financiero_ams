<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historial_predios', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Predio::class)->constrained();
            $table->foreignIdFor(DestinoEconomico::class)->constrained();
            $table->string('tipo_documento', 2);
            $table->string('documento', 30);
            $table->tinyText('nombre_propietario');
            $table->text('direccion');
            $table->double('hectareas', 8, 2);
            $table->double('metros_cuadrados', 8, 2);
            $table->double('area_construida', 8, 2);
            $table->double('tasa_por_mil', 4, 1);
            $table->integer('estrato');
            $table->enum('tipo_predio', ['rural', 'urbano']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_predios');
    }
};
