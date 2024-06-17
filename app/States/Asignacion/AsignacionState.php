<?php
namespace App\States\Asignacion;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

/**
 * @extends State<\App\Models\Asignacion>
 */
abstract class AsignacionState extends State
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
            ->allowTransition(Aprobado::class, Evaluado::class)
        ;
    }

    public function transitionableStatesWith(string $item): array
    {
        return collect($this->transitionableStates())
            ->mapWithKeys(function ($state) use ($item) {
                $stateClass = 'App\\States\\Asignacion\\' . ucfirst($state);
                return [$state => (new $stateClass($this))->$item()];
            })
            ->toArray();
    }
}
