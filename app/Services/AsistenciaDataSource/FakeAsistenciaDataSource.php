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
        $evento1 = new EventoData('EVENTO1', 'Evento 1', 'Proveedor 1');
        $empleados = [];
        for ($i = 0; $i <= 20; $i++) {
            $empleados[] = new EmpleadoSesionData(
                fake()->company,
                fake()->lastName() . ',' . fake()->name,
                fake()->boolean
            );
        }

        return new AsistenciaData($evento1, $sesion1, collect($empleados));
    }
}
