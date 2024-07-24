<?php

namespace App\Filament\Establecimiento\Resources\SolicitudResource\Pages;

use App\Filament\Establecimiento\Resources\SolicitudResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSolicituds extends ManageRecords
{
    protected static string $resource = SolicitudResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
