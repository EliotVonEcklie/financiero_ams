<?php

use App\Models\CodigoDestinoEconomico;
use App\Models\Predio;
use App\Models\PredioEstrato;
use App\Models\PredioTipo;
use App\Models\User;
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
        Schema::create('predio_informacions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Predio::class)->constrained();
            $table->foreignIdFor(CodigoDestinoEconomico::class)->constrained();
            $table->text('direccion');
            $table->double('hectareas', 16, 2);
            $table->double('metros_cuadrados', 16, 2);
            $table->double('area_construida', 16, 2);
            $table->foreignIdFor(PredioEstrato::class)->nullable()->default(null);
            $table->foreignIdFor(PredioTipo::class)->constrained();
            $table->foreignIdFor(User::class)->nullable()->default(null);
            $table->timestamps();

            $table->unique(['predio_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predio_informacions');
    }
};
