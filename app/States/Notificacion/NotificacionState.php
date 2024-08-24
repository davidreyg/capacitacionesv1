<?php
namespace App\States\Notificacion;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

/**
 * @extends State<\App\Models\Notificacion>
 */
abstract class NotificacionState extends State
{
    abstract public function color(): string;
    abstract public function display(): string;
    abstract public function action(): string;
    abstract public function icon(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Registrado::class)
            ->allowTransition(Registrado::class, Verificado::class, RegistradoToVerificado::class)
        ;
    }

    public function transitionableStatesWith(string $item): array
    {
        return collect($this->transitionableStates())
            ->mapWithKeys(function ($state) use ($item) {
                $stateClass = 'App\\States\\Notificacion\\' . ucfirst($state);
                return [$state => (new $stateClass($this))->$item()];
            })
            ->toArray();
    }
}
