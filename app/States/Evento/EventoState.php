<?php
namespace App\States\Evento;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

/**
 * @extends State<\App\Models\Evento>
 */
abstract class EventoState extends State
{
    abstract public function color(): string;
    abstract public function display(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Creado::class)
            ->allowTransition(Creado::class, Iniciado::class)
            ->allowTransition(Iniciado::class, Finalizado::class)
        ;
    }

    public function transitionableStatesFormatted(): array
    {
        return collect($this->transitionableStates())
            ->mapWithKeys(function ($state) {
                $stateClass = 'App\\States\\Evento\\' . ucfirst($state);
                return [$state => (new $stateClass($this))->display()];
            })
            ->toArray();
    }
}
