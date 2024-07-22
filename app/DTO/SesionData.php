<?php
// app/DTO/SesionData.php
namespace App\DTO;

class SesionData
{
    public int $id;
    public string $nombre;

    public function __construct(int $id, string $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }
}
