<?php
namespace App\Actions\Evento;

use App\Models\Empleado;
use App\Models\Evento;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class InscribirEmpleados
{
    use AsAction;
    /**
     * Inscribir empleados de un establecimiento a un evento.
     * @param \App\Models\Evento $evento
     * @param array $alumnos
     * @param int $establecimiento_id
     * @return bool
     * @author David Rey Gutierrez
     * @copyright (c) 2024
     */
    public function handle(Evento $evento, array $alumnos, int $establecimiento_id): void
    {
        // Obtener IDs de empleados actualmente registrados para este evento y establecimiento específico
        $empleadosPrevios = $evento->empleados()
            ->where('establecimiento_id', $establecimiento_id)
            ->pluck('empleado_id')
            ->toArray();

        // Se suma los inscritos + las vacantes disponibles. para poder seleccionar / deseleccionar empleados.
        $vacantesDisponibles = $evento->vacantes_disponibles + count($empleadosPrevios);

        if (!$evento->libre || isset($evento->vacantes)) {
            if ((count($alumnos) > $vacantesDisponibles)) {
                Notification::make()
                    ->title("No hay vacantes suficientes.")
                    ->body("Solo quedan $evento->vacantes_disponibles disponibles.")
                    ->danger()
                    ->send();
                throw new Halt("No hay vancantes suficientes");
            }
        }
        // Actualizar la relación para este establecimiento
        // Primero, eliminar todas las relaciones actuales de empleados del establecimiento con el evento
        $evento->empleados()->detach($empleadosPrevios);

        // Luego, añadir las nuevas relaciones
        $evento->empleados()->attach($alumnos);
        Notification::make()
            ->title('Alumnos inscritos correctamente.')
            ->success()
            ->send();
    }
}
