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
            $table->integer('norma_predial_tasa')->default(100)->after('norma_predial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estatutos', function (Blueprint $table) {
            $table->dropColumn('norma_predial_tasa');
        });
    }
};
