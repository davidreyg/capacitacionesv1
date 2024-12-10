<?php

namespace App\Enums\RegistroAccidente;

use Filament\Support\Contracts\HasLabel;

// FIXME: Esto es peligroso. deberia ser un array el que se inserte ala base de datos. ya que puede variar
enum GravedadEnum: string implements HasLabel
{
    case ACCIDENTE_LEVE = 'Accidente Leve';
    case ACCIDENTE_INCAPACITANTE = 'Accidente Incapacitante';
    case ACCIDENTE_MORTAL = 'Accidente Mortal';

    public function getLabel(): ?string
    {
        return (string) $this->value;
    }
}
