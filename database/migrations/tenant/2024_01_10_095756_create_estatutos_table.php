<?php

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
        Schema::create('estatutos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->year('vigencia_desde');
            $table->year('vigencia_hasta');
            $table->boolean('norma_predial');
            $table->boolean('bomberil');
            $table->boolean('bomberil_predial')->nullable(); // true = a base del predial, false = a base del avaluo
            $table->boolean('bomberil_tarifa')->nullable(); // true = tasa por mil, false = porcentaje
            $table->integer('bomberil_tasa')->nullable();
            $table->boolean('ambiental');
            $table->boolean('ambiental_predial')->nullable(); // true = a base del predial, false = a base del avaluo
            $table->boolean('ambiental_tarifa')->nullable(); // true = tasa por mil, false = porcentaje
            $table->integer('ambiental_tasa')->nullable();
            $table->boolean('alumbrado');
            $table->boolean('alumbrado_urbano')->nullable();
            $table->boolean('alumbrado_rural')->nullable();
            $table->boolean('alumbrado_tarifa')->nullable(); // true = tasa por mil, false = porcentaje
            $table->integer('alumbrado_tasa')->nullable();
            $table->integer('recibo_caja');
            $table->softDeletes();
            $table->foreignIdFor(User::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estatutos');
    }
};
