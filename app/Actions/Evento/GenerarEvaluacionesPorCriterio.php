<?php
namespace App\Actions\Evento;

use App\Models\Evaluacion;
use App\Models\Evento;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerarEvaluacionesPorCriterio
{
    use AsAction;
    public function handle(Evento $evento, int $criterioId): void
    {
        // Obtener todos los alumnos
        $empleados = $evento->empleados;
        if ($empleados->count() === 0) {
            Notification::make()
                ->title("No hay alumnos registrados para este evento.")
                ->warning()
                ->send();
            throw new Halt("No hay alumnos registrados para este evento");
        }
        // Crear evaluaciones para cada alumno y el primer criterio
        foreach ($empleados as $empleado) {
            Evaluacion::updateOrCreate(
                [
                    'evento_id' => $evento->id,
                    'empleado_id' => $empleado->id,
                    'criterio_evaluacion_id' => $criterioId
                ],
                [
                    'nota' => 0 // Valor inicial, ajustar según necesidad
                ]
            );
        }
    }
}
