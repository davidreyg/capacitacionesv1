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
        Schema::create('capacitacion_evento', function (Blueprint $table) {
            $table->foreignId('evento_id')->constrained()->cascadeOnDelete();
            $table->foreignId('capacitacion_id')->constrained();
            $table->boolean('aprobado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacitacion_evento');
    }
};
