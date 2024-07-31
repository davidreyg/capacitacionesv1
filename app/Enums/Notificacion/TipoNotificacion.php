<?php

namespace App\Enums\Notificacion;

use Filament\Support\Contracts\HasLabel;

enum TipoNotificacion: string implements HasLabel
{
    case ACCIDENTE = 'Accidente';
    case INCIDENTE = 'Incidente';

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
