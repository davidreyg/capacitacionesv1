<?php
namespace App\States\Notificacion;

class Registrado extends NotificacionState
{
    public static $name = 'registrado';

    public function color(): string
    {
        return 'gray';
    }

    public function display(): string
    {
        return 'Registrado';
    }
    public function action(): string
    {
        return 'Registrar';
    }

    public function icon(): string
    {
        return 'tabler-file-info';
    }
}
