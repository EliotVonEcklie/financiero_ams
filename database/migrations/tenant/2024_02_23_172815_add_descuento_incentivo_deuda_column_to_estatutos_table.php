<?php

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
        Schema::table('estatutos', function (Blueprint $table) {
            $table->boolean('descuento_incentivo_deuda')->default(true)->before('norma_predial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estatutos', function (Blueprint $table) {
            $table->dropColumn('descuento_incentivo_deuda');
        });
    }
};
