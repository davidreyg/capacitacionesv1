<?php

namespace App\Filament\Establecimiento\Resources\EventoResource\Pages;

use App\Filament\Establecimiento\Resources\EventoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventos extends ListRecords
{
    protected static string $resource = EventoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
