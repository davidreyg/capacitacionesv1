<?php

namespace App\Filament\Admin\Resources\TipoCapacitacionResource\Pages;

use App\Filament\Admin\Resources\TipoCapacitacionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipoCapacitacions extends ManageRecords
{
    protected static string $resource = TipoCapacitacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
