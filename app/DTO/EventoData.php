<?php
namespace App\DTO;

class EventoData
{
    public string $nombre_capacitacion;
    public string $codigo_capacitacion;
    public string $proveedor;

    public function __construct(string $codigo_capacitacion, string $nombre_capacitacion, string $proveedor)
    {
        $this->codigo_capacitacion = $codigo_capacitacion;
        $this->nombre_capacitacion = $nombre_capacitacion;
        $this->proveedor = $proveedor;
    }
}
