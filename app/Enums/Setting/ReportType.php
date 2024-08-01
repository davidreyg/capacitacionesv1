<?php

namespace App\Enums\Setting;

use Filament\Support\Contracts\HasLabel;

enum ReportType: string implements HasLabel
{
    case ASISTENCIA = 'reporte-asistencia';
    case FICHA_CAPACITACION = 'ficha-capacitacion';

    public function getLabel(): ?string
    {
        return (string) ucwords($this->name);
    }
}
