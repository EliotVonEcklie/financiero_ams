<?php

use App\Models\Predio;
use App\Models\DestinoEconomico;
use App\Models\PredioEstrato;
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
            $table->date('fecha');
            $table->string('tipo_documento', 2);
            $table->string('documento', 30);
            $table->tinyText('nombre_propietario');
            $table->text('direccion');
            $table->double('hectareas', 16, 2);
            $table->double('metros_cuadrados', 16, 2);
            $table->double('area_construida', 16, 2);
            $table->double('tasa_por_mil', 16, 2);
            $table->foreignIdFor(PredioEstrato::class)->constrained();
            $table->enum('tipo_predio', ['rural', 'urbano']);

            $table->unique(['predio_id', 'fecha']);
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
