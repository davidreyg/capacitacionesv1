<?php
namespace App\States\Solicitud;

use Spatie\ModelStates\State;

/**
 * @extends State<\App\Models\Solicitud>
 */
class Habilitado extends SolicitudState
{
    public static $name = 'habilitado';


    public function color(): string
    {
        return 'success';
    }

    public function display(): string
    {
        return 'Habilitado';
    }

    public function action(): string
    {
        return 'Habilitar';
    }

    public function icon(): string
    {
        return 'tabler-file-smile';
    }
}
