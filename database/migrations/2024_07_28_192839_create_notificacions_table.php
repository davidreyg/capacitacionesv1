<?php

use App\Enums\Notificacion\TipoAfectacion;
use App\Enums\Notificacion\TipoNotificacion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notificacions', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->string('lugar', 100);
            $table->text('descripcion_situacion')->nullable();
            $table->text('descripcion_lesion')->nullable();
            $table->enum('tipo_notificacion', [TipoNotificacion::ACCIDENTE->value, TipoNotificacion::INCIDENTE->value]);
            $table->enum('tipo_afectacion', [TipoAfectacion::AMBIENTE->value, TipoAfectacion::TRABAJADOR->value]);

            $table->foreignId('empleado_id')->constrained();

            $table->unsignedBigInteger('responsable_id');
            $table->foreign('responsable_id')->references('id')->on('empleados');

            $table->unsignedBigInteger('reportante_id');
            $table->foreign('reportante_id')->references('id')->on('empleados');
            $table->unsignedBigInteger('testigo1_id')->nullable();
            $table->foreign('testigo1_id')->references('id')->on('empleados');
            $table->unsignedBigInteger('testigo2_id')->nullable();
            $table->foreign('testigo2_id')->references('id')->on('empleados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacions');
    }
};
