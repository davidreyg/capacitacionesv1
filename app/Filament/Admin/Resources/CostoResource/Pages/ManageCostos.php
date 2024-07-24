<?php

namespace App\Filament\Admin\Resources\CostoResource\Pages;

use App\Filament\Admin\Resources\CostoResource;
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
