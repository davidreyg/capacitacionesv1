<?php
namespace App\States\Notificacion;

class Verificado extends NotificacionState
{
    public static $name = 'verificado';


    public function color(): string
    {
        return 'info';
    }

    public function display(): string
    {
        return 'Verificado';
    }

    public function action(): string
    {
        return 'Verificar';
    }
    public function icon(): string
    {
        return 'tabler-eye-check';
    }
}
