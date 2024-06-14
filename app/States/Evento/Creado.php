<?php
namespace App\States\Evento;

use Spatie\ModelStates\State;

/**
 * @extends State<\App\Models\Evento>
 */
class Creado extends EventoState
{
    public static $name = 'creado';

    public function color(): string
    {
        return 'info';
    }

    public function display(): string
    {
        return 'Creado';
    }
}
