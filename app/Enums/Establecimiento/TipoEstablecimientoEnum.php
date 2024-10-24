<?php

namespace App\Enums\Establecimiento;

use Filament\Support\Contracts\HasLabel;
use JaOcero\RadioDeck\Contracts\HasDescriptions;

enum TipoEstablecimientoEnum: string implements HasLabel, HasDescriptions
{
    case DIRIS = 'DIRIS';
    case RIS = 'RIS';
    case ESTABLECIMIENTO = 'ESTABLECIMIENTO';

    public function getLabel(): ?string
    {
        return (string) $this->value;
    }

    public function getDescriptions(): ?string
    {
        return null;
    }
}
