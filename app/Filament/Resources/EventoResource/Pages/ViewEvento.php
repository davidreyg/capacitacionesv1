<?php

namespace App\Filament\Resources\EventoResource\Pages;

use App\Filament\Resources\EventoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEvento extends ViewRecord
{
    protected static string $resource = EventoResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['solicitud_ids'] = $this->getRecord()->solicituds()->pluck('id');
        return $data;
    }
}
