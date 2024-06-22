<?php

namespace App\Filament\Clusters\CatalogoEmpleados\Resources\CondicionResource\Pages;

use App\Filament\Clusters\CatalogoEmpleados\Resources\CondicionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCondicions extends ManageRecords
{
    protected static string $resource = CondicionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
