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
        Schema::create('capacitacions', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique();
            $table->string('nombre', 225);
            $table->tinyText('perfil')->nullable();
            $table->tinyText('objetivo_aprendizaje');
            $table->tinyText('objetivo_desempeño');
            $table->tinyText('problema');
            $table->boolean('activo');
            // RELACIONES
            $table->foreignId('tipo_capacitacion_id')->constrained();
            $table->foreignId('eje_tematico_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacitacions');
    }
};
