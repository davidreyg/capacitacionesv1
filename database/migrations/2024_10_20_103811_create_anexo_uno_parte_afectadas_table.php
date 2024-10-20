<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anexo_uno_parte_afectadas', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo')->unique();  // El código sigue siendo único, pero no es la primary key
            $table->string('descripcion', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anexo_uno_parte_afectadas');
    }
};
