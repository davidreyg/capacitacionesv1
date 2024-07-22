<?php
namespace App\DTO;

use Illuminate\Support\Collection;

class AsistenciaData
{
    public EventoData $evento;
    public SesionData $sesion;

    /** @var Collection<int, EmpleadoSesionData> */
    public Collection $empleados;

    /**
     * Summary of __construct
     * @param \App\DTO\SesionData $sesion
     * @param Collection<int, EmpleadoSesionData> $empleados
     * @author David Rey Gutierrez
     * @copyright (c) 2024
     */
    public function __construct(EventoData $evento, SesionData $sesion, Collection $empleados)
    {
        $this->evento = $evento;
        $this->sesion = $sesion;
        $this->empleados = $empleados;
    }
}