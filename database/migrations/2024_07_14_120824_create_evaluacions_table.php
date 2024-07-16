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
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('evento_id')->constrained()->cascadeOnDelete();
            $table->foreignId('criterio_evaluacion_id')->constrained()->cascadeOnDelete();
            $table->foreignId('empleado_id')->constrained();
            $table->decimal('nota', 4, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacions');
    }
};
