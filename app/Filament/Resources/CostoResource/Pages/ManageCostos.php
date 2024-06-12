<?php

namespace App\Filament\Resources\CostoResource\Pages;

use App\Filament\Resources\CostoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCostos extends ManageRecords
{
    protected static string $resource = CostoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
