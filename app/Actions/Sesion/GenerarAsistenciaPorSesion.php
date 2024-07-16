<?php
namespace App\Actions\Sesion;

use App\Models\Sesion;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerarAsistenciaPorSesion
{
    use AsAction;
    public function handle(Sesion $sesion): void
    {
        // Obtener todos los alumnos
        $sesion->loadMissing(['evento.empleados']);
        $empleados = $sesion->evento->empleados;
        if ($empleados->count() === 0) {
            Notification::make()
                ->title("No hay alumnos registrados para este evento.")
                ->warning()
                ->send();
            throw new Halt("No hay alumnos registrados para este evento");
        }
        // registrar en la tabla pivote los empleados registrados del evento.
        $sesion->empleados()->syncWithPivotValues($empleados->pluck('id'), ['is_present' => true]);

    }
}
