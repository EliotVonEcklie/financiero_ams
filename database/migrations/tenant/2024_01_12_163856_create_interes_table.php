<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interes', function (Blueprint $table) {
            $table->id();
            $table->year('vigencia');
            $table->integer('mes');
            $table->double('moratorio', 16, 2);
            $table->double('corriente', 16, 2)->default(0.0);
            $table->softDeletes();
            $table->foreignIdFor(User::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interes');
    }
};
