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
        Schema::create('notificacion_causa_basica', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notificacion_id')->constrained()->cascadeOnDelete();
            $table->foreignId('causa_basica_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacion_causa_basica');
    }
};
