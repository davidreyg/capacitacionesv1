<?php
namespace App\States\Solicitud;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

/**
 * @extends State<\App\Models\Solicitud>
 */
abstract class SolicitudState extends State
{
    abstract public function color(): string;
    abstract public function display(): string;
    abstract public function action(): string;
    abstract public function icon(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Solicitado::class)
            ->allowTransition(Solicitado::class, Aprobado::class)
            ->allowTransition(Solicitado::class, Evaluado::class)
            ->allowTransition(Aprobado::class, Habilitado::class)
            ->allowTransition(Aprobado::class, Solicitado::class)
            ->allowTransition(Aprobado::class, Evaluado::class)
        ;
    }

    public function transitionableStatesWith(string $item): array
    {
        return collect($this->transitionableStates())
            ->mapWithKeys(function ($state) use ($item) {
                $stateClass = 'App\\States\\Solicitud\\' . ucfirst($state);
                return [$state => (new $stateClass($this))->$item()];
            })
            ->toArray();
    }
}
