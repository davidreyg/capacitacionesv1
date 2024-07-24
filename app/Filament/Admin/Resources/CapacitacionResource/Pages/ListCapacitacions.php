<?php

namespace App\Filament\Admin\Resources\CapacitacionResource\Pages;

use App\Filament\Admin\Resources\CapacitacionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCapacitacions extends ListRecords
{
    protected static string $resource = CapacitacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
