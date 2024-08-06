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
        Schema::create('tipo_contacto_causa_inmediata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_contacto_id')->constrained()->cascadeOnDelete();
            $table->foreignId('causa_inmediata_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_contacto_causa_inmediata');
    }
};
