<?php
namespace App\States\Asignacion;

use Spatie\ModelStates\State;

/**
 * @extends State<\App\Models\Asignacion>
 */
class Evaluado extends AsignacionState
{
    public static $name = 'evaluado';


    public function color(): string
    {
        return 'danger';
    }

    public function display(): string
    {
        return 'Evaluado';
    }

    public function action(): string
    {
        return 'Evaluar';
    }
    public function icon(): string
    {
        return 'tabler-file-dislike';
    }
}
