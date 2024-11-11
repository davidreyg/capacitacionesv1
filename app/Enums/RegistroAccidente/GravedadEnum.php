<?php

namespace App\Enums\RegistroAccidente;

use Filament\Support\Contracts\HasLabel;

enum GravedadEnum: string implements HasLabel
{
    case LEVE = 'Accidente Leve';
    case INCAPACITANTE = 'Accidente Incapacitante';
    case MORTAL = 'Mortal';

    public function getLabel(): ?string
    {
        return (string) $this->value;
    }
}
