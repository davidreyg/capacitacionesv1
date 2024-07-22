<?php
namespace App\Services\Interfaces;

use App\DTO\AsistenciaData;

interface AsistenciaSourceInterface
{
    public function getData(int $sesionId): AsistenciaData;

    // /**
    //  * @param int $sesionId
    //  * @return Collection<int, \App\DTO\AsistenciaData>
    //  */
    // public function getDataBySessionId(int $sesionId): Collection;
}
