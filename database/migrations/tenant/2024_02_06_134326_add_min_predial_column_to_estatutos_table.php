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
            $table->integer('min_predial')->default(0)->after('norma_predial_tasa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estatutos', function (Blueprint $table) {
            $table->dropColumn('min_predial');
        });
    }
};
