<?php

namespace App\Filament\Admin\Resources\EventoResource\Pages;

use App\Filament\Admin\Resources\EventoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class ViewEvento extends ViewRecord
{
    use NestedPage;

    protected static string $resource = EventoResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['solicitud_ids'] = $this->getRecord()->load('solicituds')->solicituds()->pluck('id');
        return $data;
    }
}
