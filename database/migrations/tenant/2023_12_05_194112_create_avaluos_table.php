<?php

use App\Models\Predio;
use App\Models\PredioTipo;
use App\Models\PredioEstrato;
use App\Models\CodigoDestinoEconomico;
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
            $table->foreignIdFor(CodigoDestinoEconomico::class)->constrained();
            $table->year('vigencia');
            $table->boolean('pagado')->default(false);
            $table->text('direccion');
            $table->double('valor_avaluo', 16, 2);
            $table->double('hectareas', 16, 2);
            $table->double('metros_cuadrados', 16, 2);
            $table->double('area_construida', 16, 2);
            $table->double('tasa_por_mil', 16, 2)->default(-1);
            $table->foreignIdFor(PredioEstrato::class)->nullable()->default(null);
            $table->foreignIdFor(PredioTipo::class)->constrained();

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
