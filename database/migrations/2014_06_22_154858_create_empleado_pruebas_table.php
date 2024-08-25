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
        Schema::create('empleado_prueba', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleado_id')->constrained()->cascadeOnDelete();
            $table->foreignId('prueba_id')->constrained();
            $table->foreignId('metodo_prueba_id')->constrained();
            $table->date('fecha_resultado');
            $table->string('resultado');
            $table->date('fecha_aislamiento');
            $table->smallInteger('dias_aislamiento');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado_prueba');
    }
};
