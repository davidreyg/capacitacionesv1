<?php
namespace App\States\Evento;

use Spatie\ModelStates\State;

/**
 * @extends State<\App\Models\Evento>
 */
class Finalizado extends EventoState
{
    public static $name = 'finalizado';


    public function color(): string
    {
        return 'danger';
    }

    public function display(): string
    {
        return 'Finalizado';
    }
}
