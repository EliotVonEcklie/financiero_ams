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
        Schema::create('descuentos', function (Blueprint $table) {
            $table->id();
            $table->boolean('es_nacional')->default(false);
            $table->integer('hasta')->nullable(); // can be 'vigencia' or 'mes', depending on 'es_nacional'
            $table->integer('porcentaje');
            $table->softDeletes();
            $table->foreignIdFor(User::class)->nullable();
            $table->timestamps();

            $table->unique(['es_nacional', 'hasta']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descuentos');
    }
};
