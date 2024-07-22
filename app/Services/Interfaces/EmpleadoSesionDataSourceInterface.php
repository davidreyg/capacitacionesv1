<?php
namespace App\Services\Interfaces;

use Illuminate\Support\Collection;

interface EmpleadoSesionDataSourceInterface
{
    public function getData(): Collection;
    public function getDataBySessionId(int $sesionId): Collection;
}
