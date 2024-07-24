<?php

namespace App\Filament\Admin\Clusters\CatalogoEmpleados\Resources\RegimenLaboralResource\Pages;

use App\Filament\Admin\Clusters\CatalogoEmpleados\Resources\RegimenLaboralResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRegimenLaborals extends ManageRecords
{
    protected static string $resource = RegimenLaboralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
