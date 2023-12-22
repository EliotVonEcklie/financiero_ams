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
        Schema::create('predio_estratos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('estrato');
            $table->softDeletes();
            $table->foreignIdFor(User::class, 'modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predio_estratos');
    }
};
