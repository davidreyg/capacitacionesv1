<?php

namespace App\Enums\AnexoUno;

use Filament\Support\Contracts\HasLabel;
use JaOcero\RadioDeck\Contracts\HasDescriptions;
use JaOcero\RadioDeck\Contracts\HasIcons;

enum TipoAnexoUno: string implements HasLabel, HasDescriptions, HasIcons
{
    case ACCIDENTE = 'Aviso de Accidente de Trabajo';
    case ENFERMEDADES = 'Aviso de Enfermedades Relacionadas al Trabajo';

    public function getLabel(): ?string
    {
        return (string) $this->value;
    }

    public function getDescriptions(): ?string
    {
        return null;
    }

    public function getIcons(): ?string
    {
        return match ($this) {
            self::ACCIDENTE => 'tabler-mood-sad-dizzy',
            self::ENFERMEDADES => 'tabler-mood-look-down',
        };
    }
}
