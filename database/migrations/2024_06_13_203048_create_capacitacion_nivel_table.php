<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('capacitacion_nivel', function (Blueprint $table) {
            $table->foreignId('capacitacion_id')->constrained()->cascadeOnDelete();
            $table->foreignId('nivel_id')->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('capacitacion_nivel');
    }
};
