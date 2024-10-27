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
        Schema::create('anexo_unos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_presentacion');
            $table->string('tipo', 100);

            // EMPRESA DEL EMPLEADOR - DEBERIA SER SIEMPRE DIRIS.
            $table->unsignedBigInteger('establecimiento_empleador_id');
            $table->foreign('establecimiento_empleador_id')->references('id')->on('establecimientos');

            // // EMPRESA DONDE LABURA - DEBERIA SER DONDE TRABAJA
            $table->unsignedBigInteger('establecimiento_laboral_id');
            $table->foreign('establecimiento_laboral_id')->references('id')->on('establecimientos');
            $table->timestamps();

            $table->foreignId('empleado_id')->constrained(); //DATOS DEL TRABAJADOR

            // // IV. DATOS DEL ACCIDENTE DE TRABAJO
            $table->dateTime('fecha_hora_accidente');
            $table->foreignId('anexo_uno_forma_accidente_id')->constrained(); //tabla3
            $table->foreignId('anexo_uno_agente_causante_id')->constrained(); //tabla4
            $table->string('accidente_centro_medico_nombre');
            $table->string('accidente_centro_medico_ruc');
            $table->date('accidente_fecha_ingreso');
            $table->foreignId('anexo_uno_parte_afectada_id')->constrained(); //tabla5
            $table->foreignId('anexo_uno_naturaleza_lesion_id')->constrained(); //tabla6

            // CONSECUENCIAS DEL ACCIDENTE.
            $table->string('accidente_medico_nombre');
            $table->unsignedInteger('accidente_medico_numero_colegiatura');

            // // IV. DATOS DE LA ENFERMEDAD RELACIONADA A LTRAABAJO
            $table->foreignId('anexo_uno_enfermedades_trabajo_id')->constrained(); //tabla7

            $table->string('enfermedad_centro_medico_nombre');
            $table->string('enfermedad_centro_medico_ruc');
            $table->date('enfermedad_fecha_ingreso');
            $table->string('enfermedad_medico_nombre');
            $table->unsignedInteger('enfermedad_medico_numero_colegiatura');

            // Relacion con notficacion
            $table->foreignId('notificacion_id')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anexo_unos');
    }
};
