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
        Schema::create('registro_accidente_responsables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_accidente_id')->constrained(); //DATOS DEL TRABAJADOR
            $table->foreignId('empleado_id')->constrained(); //DATOS DEL TRABAJADOR
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_accidente_responsables');
    }
};
