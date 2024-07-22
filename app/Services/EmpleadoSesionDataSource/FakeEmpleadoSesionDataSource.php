<?php
namespace App\Services\EmpleadoSesionDataSource;

use App\Services\Interfaces\EmpleadoSesionDataSourceInterface;
use Illuminate\Support\Collection;
use App\DTO\EmpleadoSesionData;
use App\DTO\SesionData;
use App\DTO\EmpleadoData;

class FakeEmpleadoSesionDataSource implements EmpleadoSesionDataSourceInterface
{
    public function getData(): Collection
    {
        $sesion1 = new SesionData(1, 'Fake Session 1');
        $empleado1 = new EmpleadoData(1, 'Fake Employee 1');
        $sesion2 = new SesionData(2, 'Fake Session 2');
        $empleado2 = new EmpleadoData(2, 'Fake Employee 2');

        return collect([
            new EmpleadoSesionData(1, $sesion1, $empleado1, true),
            new EmpleadoSesionData(2, $sesion2, $empleado2, false),
        ]);
    }

    public function getDataBySessionId(int $sessionId): Collection
    {
        return $this->getData()->filter(function ($item) use ($sessionId) {
            return $item->sesion->id === $sessionId;
        });
    }
}
