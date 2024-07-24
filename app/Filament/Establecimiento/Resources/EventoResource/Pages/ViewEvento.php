<?php

namespace App\Filament\Establecimiento\Resources\EventoResource\Pages;

use App\Filament\Establecimiento\Resources\EventoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEvento extends ViewRecord
{
    protected static string $resource = EventoResource::class;
    protected ?string $heading = 'Ver Evento';

    public static function getNavigationLabel(): string
    {
        return 'Ver Evento';
    }
}
