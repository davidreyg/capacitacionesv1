<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleado_sesion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesion_id')->constrained()->cascadeOnDelete();
            $table->foreignId('empleado_id')->constrained();
            $table->boolean('is_present');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado_sesion');
    }
};
