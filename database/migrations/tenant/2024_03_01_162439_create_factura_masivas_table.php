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
        Schema::create('factura_masivas', function (Blueprint $table) {
            $table->id();
            $table->integer('min_deuda');
            $table->integer('vigencias');
            $table->boolean('rurales');
            $table->boolean('urbanos');
            $table->integer('last_resolucion');
            $table->boolean('processing');
            $table->string('path')->nullable();
            $table->foreignIdFor(User::class)->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_masivas');
    }
};
