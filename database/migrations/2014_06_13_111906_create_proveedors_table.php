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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_documento')->unsigned()->unique();
            $table->string('razon_social', 100);
            $table->integer('telefono')->unsigned()->nullable();
            $table->string('correo', 100)->nullable();
            $table->date('fecha_alta');
            $table->date('fecha_baja')->nullable();
            $table->boolean('is_active');
            $table->text('observacion')->nullable();
            $table->foreignId('tipo_documento_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
