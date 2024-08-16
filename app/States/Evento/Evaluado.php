<?php
namespace App\States\Evento;

use Spatie\ModelStates\State;

/**
 * @extends State<\App\Models\Evento>
 */
class Evaluado extends EventoState
{
    public static $name = 'evaluado';


    public function color(): string
    {
        return 'info';
    }

    public function display(): string
    {
        return 'Evaluado';
    }
}
