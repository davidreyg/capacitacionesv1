<?php

namespace App\Enums\RegistroAccidente;

use Filament\Support\Contracts\HasLabel;

enum CausasGrupoEnum: string implements HasLabel
{
    case CAUSAS_INMEDIATAS = 'Causas inmediatas';
    case CAUSAS_BASICAS = 'Causas Basicas';

    public function getLabel(): ?string
    {
        return (string) $this->value;
    }
}
