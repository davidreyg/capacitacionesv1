<?php

namespace App\Enums\TipoAnexoUno;

use Filament\Support\Contracts\HasLabel;

enum TipoAnexoUno: string implements HasLabel
{
    case ACCIDENTE = 'Aviso de Accidente de Trabajo';
    case ENFERMEDADES = 'Aviso de Enfermedades Relacionadas al Trabajo';

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
