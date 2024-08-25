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
        Schema::create('empleado_vacuna', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleado_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vacuna_id')->constrained();
            $table->foreignId('fabricante_id')->constrained();
            $table->string('estado');
            $table->string('dosis');
            $table->date('fecha_vacuna');
            $table->tinyInteger('edad_atencion')->unsigned();
            $table->string('establecimiento', 255);
            $table->string('lote_vacuna', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado_vacuna');
    }
};
