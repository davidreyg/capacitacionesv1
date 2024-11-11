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
        Schema::create('registro_accidentes', function (Blueprint $table) {
            $table->id();
            // 1. EMPRESA DEL EMPLEADOR - DEBERIA SER SIEMPRE DIRIS.
            $table->unsignedBigInteger('establecimiento_principal_id');
            $table->foreign('establecimiento_principal_id')->references('id')->on('establecimientos');

            //REGISTRO ACCIDENTE.
            $table->tinyInteger('principal_trabajadores_sctr')->nullable()->unsigned();
            $table->tinyInteger('principal_trabajadores_no_sctr')->nullable()->unsigned();
            $table->string('principal_nombre_aseguradora', 100)->nullable();

            // 2. EMPRESA DONDE LABURA - DEBERIA SER DONDE TRABAJA
            $table->unsignedBigInteger('establecimiento_intermediario_id');
            $table->foreign('establecimiento_intermediario_id')->references('id')->on('establecimientos');
            $table->tinyInteger('intermediario_trabajadores_sctr')->nullable()->unsigned();
            $table->tinyInteger('intermediario_trabajadores_no_sctr')->nullable()->unsigned();
            $table->string('intermediario_nombre_aseguradora', 100)->nullable();
            $table->timestamps();

            // 3. Datos del ttrabajador.
            $table->foreignId('empleado_id')->constrained(); //DATOS DEL TRABAJADOR

            // 4. Investigacion del accidente de trabajo
            $table->dateTime('fecha_hora_accidente');
            $table->date('fecha_inicio_investigacion');
            $table->string('lugar_accidente');
            $table->string('gravedad_accidente');
            $table->string('grado_accidente')->nullable();
            $table->smallInteger('dias_descanso')->unsigned();
            $table->smallInteger('trabajadores_afectados')->unsigned();
            $table->string('parte_cuerpo_lesionado')->nullable();
            // 5. DESCRIPCION
            $table->text('descripcion')->nullable();
            //.6. ES UNA FOREING KEY
            // $table->text('descripcion_causas')->nullable()->default('text');

            //7. Medidas correctivas es tambien foreign

            $table->foreignId('notificacion_id')->constrained(); //DATOS DEL TRABAJADOR

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_accidentes');
    }
};
