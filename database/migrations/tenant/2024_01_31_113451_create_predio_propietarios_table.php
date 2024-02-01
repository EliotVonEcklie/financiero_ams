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
        Schema::create('predio_propietarios', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Predio::class)->constrained();
            $table->integer('orden');
            $table->string('tipo_documento', 2);
            $table->string('documento', 30);
            $table->tinyText('nombre_propietario');
            $table->foreignIdFor(User::class)->nullable()->default(null);
            $table->timestamps();

            $table->unique(['predio_id', 'orden', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predio_propietarios');
    }
};
