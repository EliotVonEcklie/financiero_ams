<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Remove all data
        DB::table('predios')->truncate();

        Schema::table('predios', function (Blueprint $table) {
            // Drop old columns
            $table->dropUnique(['codigo_catastro', 'total', 'orden']);
            $table->dropColumn(['total', 'orden']);

            // Create new columns
            $table->foreignId('propietario_principal')->nullable()->default(null);
            $table->foreignIdFor(User::class)->nullable()->default(null);
            $table->timestamps();

            // Create new index
            $table->unique('codigo_catastro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('predios', function (Blueprint $table) {
            $table->dropIfExists('predios');
        });
    }
};
