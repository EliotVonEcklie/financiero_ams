<?php

use App\Models\PredioTipo;
use App\Models\UnidadMonetaria;
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
        Schema::create('vigencia_unidad_monetarias', function (Blueprint $table) {
            $table->id();
            $table->year('vigencia');
            $table->foreignIdFor(UnidadMonetaria::class)->constrained();
            $table->decimal('valor', 32, 2);
            $table->softDeletes();
            $table->foreignIdFor(User::class)->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vigencia_unidad_monetarias');
    }
};
