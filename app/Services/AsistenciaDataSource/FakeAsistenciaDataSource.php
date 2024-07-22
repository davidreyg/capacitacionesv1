<?php
namespace App\Services\AsistenciaDataSource;

use App\DTO\AsistenciaData;
use App\DTO\EventoData;
use App\Services\Interfaces\AsistenciaSourceInterface;
use App\DTO\EmpleadoSesionData;
use App\DTO\SesionData;

class FakeAsistenciaDataSource implements AsistenciaSourceInterface
{
    public function getData(int $sesionId): AsistenciaData
    {
        $sesion1 = new SesionData(1, 'Fake Session 1', '05-30-1998');
        $evento1 = new EventoData('EVENTO1', 'Evento 1', '05-30-1998');
        $empleadoSesion1 = new EmpleadoSesionData('Unidad organica 1', 'Empleado 1', true);
        $empleadoSesion2 = new EmpleadoSesionData('Unidad organica 2', 'Empleado 2', false);

        return new AsistenciaData($evento1, $sesion1, collect([$empleadoSesion1, $empleadoSesion2]));
    }
}
