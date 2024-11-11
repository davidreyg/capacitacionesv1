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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_documento')->unsigned()->unique();
            $table->string('nombres', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100);
            $table->date('fecha_nacimiento');
            $table->date('fecha_alta');
            $table->char('sexo', 1);
            $table->tinyInteger('plaza')->unsigned();
            $table->string('viene_de', 100);
            $table->string('email', 100)->nullable();
            $table->string('telefono', 100)->nullable();
            $table->string('direccion', 255)->nullable();

            //anexo 1
            $table->foreignId('anexo_uno_categoria_trabajador_id')->nullable()->constrained();
            $table->boolean('asegurado')->default(false);
            $table->string('essalud', 100)->nullable();
            $table->string('eps', 100)->nullable();
            // Registro accidente
            $table->integer('antiguedad_puesto')->unsigned()->nullable();
            $table->string('turno')->nullable();
            $table->integer('tiempo_experiencia')->unsigned()->nullable();

            $table->foreignId('establecimiento_id')->constrained();
            $table->foreignId('unidad_organica_id')->constrained();
            $table->foreignId('cargo_id')->constrained();
            $table->foreignId('tipo_planilla_id')->constrained();
            $table->foreignId('condicion_id')->constrained();
            $table->foreignId('desplazamiento_id')->constrained();
            $table->foreignId('regimen_laboral_id')->constrained();
            $table->foreignId('funcion_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
