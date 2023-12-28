<?php

use App\Models\User;
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
        Schema::create('codigo_destino_economicos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 2)->unique();
            $table->foreignIdFor(DestinoEconomico::class)->nullable()->default(null);
            $table->foreignIdFor(User::class)->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigo_destino_economicos');
    }
};
