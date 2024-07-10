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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->date('fecha_orden_servicio');
            $table->string('lugar', 100);
            $table->boolean('libre');
            $table->integer('vacantes')->nullable()->unsigned();
            // $table->integer('inscritos')->nullable()->unsigned();
            $table->tinyInteger('creditos')->unsigned();
            $table->tinyInteger('numero_horas')->unsigned();
            $table->string('estado');

            $table->foreignId('oportunidad_id')->constrained();
            $table->foreignId('modalidad_id')->constrained();
            $table->foreignId('capacitacion_id')->constrained();
            $table->foreignId('proveedor_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
