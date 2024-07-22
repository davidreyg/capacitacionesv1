<?php
namespace App\Services\AsistenciaDataSource;

use App\DTO\AsistenciaData;
use App\DTO\EventoData;
use App\Models\Empleado;
use App\Models\Sesion;
use App\Services\Interfaces\AsistenciaSourceInterface;
use App\DTO\EmpleadoSesionData;
use App\DTO\SesionData;

class DatabaseAsistenciaDataSource implements AsistenciaSourceInterface
{

    public function getData(int $sesionId): AsistenciaData
    {
        $sesion = Sesion::findOrFail($sesionId)->load(['empleados.unidadOrganica', 'evento.proveedor', 'evento.capacitacion']);
        $empleados = $sesion->empleados->map(function (Empleado $empleado) {
            return new EmpleadoSesionData(
                $empleado->unidadOrganica->nombre,
                "$empleado->apellido_paterno $empleado->apellido_materno, $empleado->nombres",
                $empleado->pivot->is_present
            );
        });
        return new AsistenciaData(
            new EventoData(
                $sesion->evento->capacitacion->codigo,
                $sesion->evento->capacitacion->nombre,
                $sesion->evento->proveedor->razon_social,
            ),
            new SesionData($sesion->id, $sesion->nombre, $sesion->fecha),
            $empleados
        );
    }
}
