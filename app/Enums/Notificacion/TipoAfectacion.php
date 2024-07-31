<?php

namespace App\Enums\Notificacion;

use Filament\Support\Contracts\HasLabel;

enum TipoAfectacion: string implements HasLabel
{
    case AMBIENTE = 'Al ambiente';
    case TRABAJADOR = 'La seguridad y salud del trabajador';

    public function getLabel(): ?string
    {
        return (string) ucwords($this->name);
    }
    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->value;
        }
        return $array;
    }
}
