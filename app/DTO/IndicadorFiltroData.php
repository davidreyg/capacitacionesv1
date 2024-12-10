<?php
namespace App\DTO;

use DateTime;

class IndicadorFiltroData
{
    public DateTime $fechaInicio;
    public DateTime $fechaFin;

    public function __construct(DateTime $fechaInicio, DateTime $fechaFin)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }
}