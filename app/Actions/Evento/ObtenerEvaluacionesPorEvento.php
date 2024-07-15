<?php
namespace App\Actions\Evento;

use App\Models\Evaluacion;
use App\Models\Evento;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Lorisleiva\Actions\Concerns\AsAction;

class ObtenerEvaluacionesPorEvento
{
    use AsAction;

    /**
     * Retorna una matriz con los alumnos, un array de sus notas, y su promedio.
     * @param \App\Models\Evento $evento
     * @throws \Filament\Support\Exceptions\Halt
     * @return array
     * @author David Rey Gutierrez
     * @copyright (c) 2024
     */
    public function handle(Evento $evento): array
    {
        // Obtener los criterios de evaluación para el evento
        $criterios = $evento->criterioEvaluacions;
        if ($criterios->count() === 0) {
            Notification::make()
                ->title("No ha configurado sus criterios de evaluacion.")
                ->danger()
                ->send();
            throw new Halt("No ha configurado sus criterios de evaluacion");
        }
        // Obtener los criterios de evaluación para el evento
        $evaluaciones = $evento->evaluacions;
        if ($evaluaciones->count() === 0) {
            Notification::make()
                ->title("No ha configurado sus criterios de evaluacion.")
                ->danger()
                ->send();
            throw new Halt("No ha configurado sus criterios de evaluacion");
        }
        // Obtener todos los alumnos
        $empleados = $evento->empleados;
        if ($empleados->count() === 0) {
            Notification::make()
                ->title("No hay alumnos registrados para este evento.")
                ->warning()
                ->send();
            throw new Halt("No hay alumnos registrados para este evento");
        }

        // Verificar si todos los valores de los criterios son NULL
        $todosValoresNulos = $criterios->every(function ($criterio) {
            return is_null($criterio->valor);
        });

        // Preparar la estructura de datos
        $result = [];

        foreach ($empleados as $empleado) {
            $alumnoData = [
                'empleado_id' => $empleado->id,
                'alumno' => "$empleado->apellido_paterno $empleado->apellido_materno, $empleado->nombres",
                'notas' => [],
                'promedio' => 0
            ];

            $totalNota = 0;
            $totalPeso = 0;
            $cantidadNotas = 0;

            foreach ($criterios as $criterio) {
                $nota = Evaluacion::where('empleado_id', $empleado->id)
                    ->where('evento_id', $evento->id)
                    ->where('criterio_evaluacion_id', $criterio->id)
                    ->value('nota');

                $nota = $nota ?? 0;  // Si la nota es null, asignar 0

                $alumnoData['notas'][$criterio->id] = $nota;

                if ($todosValoresNulos) {
                    // promedio simple
                    $totalNota += $nota;
                    $cantidadNotas++;
                } else {
                    // promedio ponderado
                    $totalNota += $nota * ($criterio->valor / 100);
                    $totalPeso += $criterio->valor;
                }
            }

            // Calcular el promedio
            if ($todosValoresNulos) {
                $alumnoData['promedio'] = $cantidadNotas > 0 ? round($totalNota / $cantidadNotas, 2) : 0;
            } else {
                $alumnoData['promedio'] = $totalPeso > 0 ? round($totalNota, 2) : 0;
            }

            $result[] = $alumnoData;
        }

        return $result;
    }
}
