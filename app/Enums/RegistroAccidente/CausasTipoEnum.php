<?php

namespace App\Enums\RegistroAccidente;

use Filament\Support\Contracts\HasLabel;

enum CausasTipoEnum: string implements HasLabel
{
    case ACTOS_INSEGUROS = 'Actos inseguros';
    case CONDICIONES_INSEGURAS = 'Condiciones inseguras';
    case FACTORES_PERSONALES = 'Factores personales';
    case FACTORES_TRABAJO = 'Factores trabajo';

    public function getLabel(): ?string
    {
        return (string) $this->value;
    }
}
