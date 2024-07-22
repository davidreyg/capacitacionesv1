<?php
// app/DTO/SesionData.php
namespace App\DTO;

class SesionData
{
    public int $id;
    public string $nombre;
    public string $fecha;

    public function __construct(int $id, string $nombre, string $fecha)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
    }
}
