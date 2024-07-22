<?php
namespace App\DTO;

class EmpleadoData
{
    public int $id;
    public string $nombres;

    public function __construct(int $id, string $nombres)
    {
        $this->id = $id;
        $this->nombres = $nombres;
    }
}
