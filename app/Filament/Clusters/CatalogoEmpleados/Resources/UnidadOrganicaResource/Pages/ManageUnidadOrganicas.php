<?php

namespace App\Filament\Clusters\CatalogoEmpleados\Resources\UnidadOrganicaResource\Pages;

use App\Filament\Clusters\CatalogoEmpleados\Resources\UnidadOrganicaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUnidadOrganicas extends ManageRecords
{
    protected static string $resource = UnidadOrganicaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
