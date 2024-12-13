<?php
namespace App\DTO;

use DateTime;

class IndicadorFiltroData
{
    public DateTime $fechaInicio;
    public DateTime $fechaFin;
    public ?string $establecimientoId;

    public function __construct(DateTime $fechaInicio, DateTime $fechaFin, ?string $establecimientoId = null)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->establecimientoId = $establecimientoId;
    }
}