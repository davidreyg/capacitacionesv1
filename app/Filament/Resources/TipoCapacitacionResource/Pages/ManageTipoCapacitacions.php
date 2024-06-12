<?php

namespace App\Filament\Resources\TipoCapacitacionResource\Pages;

use App\Filament\Resources\TipoCapacitacionResource;
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
