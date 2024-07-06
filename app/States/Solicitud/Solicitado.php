<?php
namespace App\States\Solicitud;

use Spatie\ModelStates\State;

/**
 * @extends State<\App\Models\Solicitud>
 */
class Solicitado extends SolicitudState
{
    public static $name = 'solicitado';

    public function color(): string
    {
        return 'gray';
    }

    public function display(): string
    {
        return 'Solicitado';
    }
    public function action(): string
    {
        return 'Solicitar';
    }

    public function icon(): string
    {
        return 'tabler-file-ifno';
    }
}
