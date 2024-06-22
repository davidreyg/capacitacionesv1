<?php

namespace App\Filament\Clusters\CatalogoEmpleados\Resources\DesplazamientoResource\Pages;

use App\Filament\Clusters\CatalogoEmpleados\Resources\DesplazamientoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDesplazamientos extends ManageRecords
{
    protected static string $resource = DesplazamientoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
