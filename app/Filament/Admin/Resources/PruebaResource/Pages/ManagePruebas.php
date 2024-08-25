<?php

namespace App\Filament\Admin\Resources\PruebaResource\Pages;

use App\Filament\Admin\Resources\PruebaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePruebas extends ManageRecords
{
    protected static string $resource = PruebaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
