<?php

use App\Models\Predio;
use App\Models\DestinoEconomico;
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
        Schema::create('avaluos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Predio::class)->constrained();
            $table->foreignIdFor(DestinoEconomico::class)->constrained();
            $table->year('vigencia');
            $table->boolean('pagado');
            $table->text('direccion');
            $table->double('valor_avaluo', 11, 2);
            $table->double('hectareas', 8, 2);
            $table->double('metros_cuadrados', 8, 2);
            $table->double('area_construida', 8, 2);
            $table->double('tasa_por_mil', 4, 1);
            $table->integer('estrato');
            $table->enum('tipo_predio', ['rural', 'urbano']);

            $table->unique(['predio_id', 'vigencia']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaluos');
    }
};
