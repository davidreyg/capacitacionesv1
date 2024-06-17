<?php
namespace App\States\Asignacion;

use Spatie\ModelStates\State;

/**
 * @extends State<\App\Models\Asignacion>
 */
class Aprobado extends AsignacionState
{
    public static $name = 'aprobado';


    public function color(): string
    {
        return 'info';
    }

    public function display(): string
    {
        return 'Aprobado';
    }

    public function action(): string
    {
        return 'Aprobar';
    }
    public function icon(): string
    {
        return 'tabler-file-like';
    }
}
