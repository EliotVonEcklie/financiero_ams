<?php

use App\Models\Predio;
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
        Schema::create('predio_avaluos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Predio::class)->constrained();
            $table->year('vigencia');
            $table->boolean('pagado')->default(false);
            $table->double('valor_avaluo', 16, 2);
            $table->double('tasa_por_mil', 16, 2)->default(-1);
            $table->foreignIdFor(User::class)->nullable()->default(null);
            $table->timestamps();

            $table->unique(['predio_id', 'vigencia']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predio_avaluos');
    }
};
