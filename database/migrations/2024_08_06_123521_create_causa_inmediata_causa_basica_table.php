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
        Schema::create('causa_inmediata_causa_basica', function (Blueprint $table) {
            $table->id();
            $table->foreignId('causa_inmediata_id')->constrained()->cascadeOnDelete();
            $table->foreignId('causa_basica_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('causa_inmediata_causa_basica');
    }
};
