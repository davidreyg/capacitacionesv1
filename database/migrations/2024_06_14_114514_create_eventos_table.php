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
            $table->tinyInteger('creditos')->unsigned();
            $table->tinyInteger('numero_horas')->unsigned();
            $table->boolean('evaluacion_simple');
            $table->string('estado');
            $table->string('job_id')->index()->nullable();

            // Auditar reprogramacion
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->uuid('reprogramador_id')->nullable();
            $table->foreign('reprogramador_id')->references('id')->on('users');
            $table->timestamp('fecha_reprogramacion')->nullable();

            //Foreings
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
