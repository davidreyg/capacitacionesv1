<?php

namespace App\Filament\Resources\MisEventosResource\Pages;

use App\Filament\Resources\MisEventosResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMisEventos extends ViewRecord
{
    protected static string $resource = MisEventosResource::class;
    protected ?string $heading = 'Ver Evento';

    public static function getNavigationLabel(): string
    {
        return 'Ver Evento';
    }
}
