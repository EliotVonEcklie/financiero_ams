<?php

use App\Models\Predio;
use App\Models\CodigoDestinoEconomico;
use App\Models\PredioEstrato;
use App\Models\PredioTipo;
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
            $table->foreignIdFor(CodigoDestinoEconomico::class)->constrained();
            $table->date('fecha');
            $table->string('tipo_documento', 2);
            $table->string('documento', 30);
            $table->tinyText('nombre_propietario');
            $table->text('direccion');
            $table->double('hectareas', 16, 2);
            $table->double('metros_cuadrados', 16, 2);
            $table->double('area_construida', 16, 2);
            $table->double('tasa_por_mil', 16, 2)->default(-1);
            $table->foreignIdFor(PredioEstrato::class)->nullable()->default(null);
            $table->foreignIdFor(PredioTipo::class)->constrained();

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
