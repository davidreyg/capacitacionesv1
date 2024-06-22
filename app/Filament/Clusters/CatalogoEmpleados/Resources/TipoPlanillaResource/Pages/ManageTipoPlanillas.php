<?php

namespace App\Filament\Clusters\CatalogoEmpleados\Resources\TipoPlanillaResource\Pages;

use App\Filament\Clusters\CatalogoEmpleados\Resources\TipoPlanillaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipoPlanillas extends ManageRecords
{
    protected static string $resource = TipoPlanillaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
