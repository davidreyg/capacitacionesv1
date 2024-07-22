<?php
namespace App\DTO;

class EmpleadoSesionData
{
    public int $id;
    public SesionData $sesion;
    public EmpleadoData $empleado;
    public bool $is_present;

    public function __construct(int $id, SesionData $sesion, EmpleadoData $empleado, bool $is_present)
    {
        $this->id = $id;
        $this->sesion = $sesion;
        $this->empleado = $empleado;
        $this->is_present = $is_present;
    }
}