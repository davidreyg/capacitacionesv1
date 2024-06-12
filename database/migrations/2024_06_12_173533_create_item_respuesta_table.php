<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('item_respuesta', function (Blueprint $table) {
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('respuesta_id')->constrained();
            $table->string('valor', 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_respuesta');
    }
};
