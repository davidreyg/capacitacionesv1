<?php
// app/Services/EmpleadoSesionDataSource/DatabaseEmpleadoSesionDataSource.php
namespace App\Services\EmpleadoSesionDataSource;

use App\Services\Interfaces\EmpleadoSesionDataSourceInterface;
use Illuminate\Support\Collection;
use App\Models\EmpleadoSesion;
use App\DTO\EmpleadoSesionData;
use App\DTO\SesionData;
use App\DTO\EmpleadoData;

class DatabaseEmpleadoSesionDataSource implements EmpleadoSesionDataSourceInterface
{
    public function getData(): Collection
    {
        return EmpleadoSesion::with(['sesion', 'empleado'])->get()->map(function ($item) {
            $sesion = new SesionData($item->sesion->id, $item->sesion->nombre);
            $empleado = new EmpleadoData($item->empleado->id, $item->empleado->nombres);
            return new EmpleadoSesionData($item->id, $sesion, $empleado, $item->is_present);
        });
    }

    public function getDataBySessionId(int $sessionId): Collection
    {
        return EmpleadoSesion::with(['sesion', 'empleado'])
            ->where('sesion_id', $sessionId)
            ->get()
            ->map(function ($item) {
                $sesion = new SesionData($item->sesion->id, $item->sesion->nombre);
                $empleado = new EmpleadoData($item->empleado->id, $item->empleado->nombres);
                return new EmpleadoSesionData($item->id, $sesion, $empleado, $item->is_present);
            });
    }
}
