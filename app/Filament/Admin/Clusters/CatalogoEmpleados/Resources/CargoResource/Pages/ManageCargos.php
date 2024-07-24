<?php

namespace App\Filament\Admin\Clusters\CatalogoEmpleados\Resources\CargoResource\Pages;

use App\Filament\Admin\Clusters\CatalogoEmpleados\Resources\CargoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCargos extends ManageRecords
{
    protected static string $resource = CargoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
