<?php

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
        Schema::create('rango_avaluos', function (Blueprint $table) {
            $table->id();
            $table->double('desde', 16, 2);
            $table->double('hasta', 16, 2);
            $table->foreignIdFor(UnidadMonetaria::class)->constrained();
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
        Schema::dropIfExists('rango_avaluos');
    }
};
