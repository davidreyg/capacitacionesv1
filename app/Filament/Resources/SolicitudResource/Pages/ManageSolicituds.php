<?php

namespace App\Filament\Resources\SolicitudResource\Pages;

use App\Filament\Resources\SolicitudResource;
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
