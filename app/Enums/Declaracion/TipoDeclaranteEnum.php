<?php

namespace App\Enums\Declaracion;

use Filament\Support\Contracts\HasLabel;
use JaOcero\RadioDeck\Contracts\HasDescriptions;
use JaOcero\RadioDeck\Contracts\HasIcons;

enum TipoDeclaranteEnum: string implements HasLabel, HasDescriptions, HasIcons
{
    case AFECTADO = 'Afectado';
    case TESTIGO = 'Testigo';
    case OTRO = 'Otro';

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
            self::AFECTADO => 'tabler-mood-sad-dizzy',
            self::TESTIGO => 'tabler-mood-look-down',
        };
    }
}
