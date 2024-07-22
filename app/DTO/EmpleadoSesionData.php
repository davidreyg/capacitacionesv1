<?php
namespace App\DTO;

class EmpleadoSesionData
{
    public string $unidadOrganica;
    public string $nombres;
    public bool $is_present;

    public function __construct(string $unidadOrganica, string $empleado, bool $is_present)
    {
        $this->unidadOrganica = $unidadOrganica;
        $this->nombres = $empleado;
        $this->is_present = $is_present;
    }
}