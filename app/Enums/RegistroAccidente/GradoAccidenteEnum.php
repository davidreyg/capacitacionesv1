<?php

namespace App\Enums\RegistroAccidente;

use Filament\Support\Contracts\HasLabel;

enum GradoAccidenteEnum: string implements HasLabel
{
    case TOTAL_TEMPORAL = 'Total temporal';
    case PARCIAL_TEMPORAL = 'Parcial temporal';
    case PARCIAL_PERMANENTE = 'Parcial permanente';
    case TOTAL_PERMANENTE = 'Total Permanente';

    public function getLabel(): ?string
    {
        return (string) $this->value;
    }
}
