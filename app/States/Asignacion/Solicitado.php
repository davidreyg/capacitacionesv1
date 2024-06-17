<?php
namespace App\States\Asignacion;

use Spatie\ModelStates\State;

/**
 * @extends State<\App\Models\Asignacion>
 */
class Solicitado extends AsignacionState
{
    public static $name = 'solicitado';

    public function color(): string
    {
        return 'default';
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
