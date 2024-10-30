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
        Schema::create('declaracions', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_declarante', 100);
            $table->date('fecha_ocurrencia');
            $table->time('hora_hocurrencia');
            $table->string('lugar_ocurrencia');
            $table->boolean('reportado_jefe_inmediato');

            // PREGUNTAS
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declaracions');
    }
};
