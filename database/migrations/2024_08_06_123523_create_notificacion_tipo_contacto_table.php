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
        Schema::create('notificacion_tipo_contacto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notificacion_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tipo_contacto_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacion_tipo_contacto');
    }
};
