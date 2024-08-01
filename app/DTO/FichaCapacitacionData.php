<?php
namespace App\DTO;

use App\Models\Evento;
use Illuminate\Support\Collection;

class FichaCapacitacionData
{
    public Evento $evento;
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
    public function __construct(Evento $evento, SesionData $sesion, Collection $empleados)
    {
        $this->evento = $evento;
        $this->sesion = $sesion;
        $this->empleados = $empleados;
    }
}