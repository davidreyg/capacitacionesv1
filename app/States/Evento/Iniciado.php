<?php
namespace App\States\Evento;

use Spatie\ModelStates\State;

/**
 * @extends State<\App\Models\Evento>
 */
class Iniciado extends EventoState
{
    public static $name = 'iniciado';


    public function color(): string
    {
        return 'success';
    }

    public function display(): string
    {
        return 'En curso';
    }
}
