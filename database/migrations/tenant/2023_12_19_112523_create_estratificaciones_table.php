<?php

use App\Models\DestinoEconomico;
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
        Schema::create('estratificaciones', function (Blueprint $table) {
            $table->id();
            $table->year('vigencia');
            $table->foreignIdFor(PredioTipo::class);
            $table->foreignIdFor(DestinoEconomico::class);
            $table->morphs('tarifa');
            $table->decimal('tasa');
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
        Schema::dropIfExists('estratificaciones');
    }
};
