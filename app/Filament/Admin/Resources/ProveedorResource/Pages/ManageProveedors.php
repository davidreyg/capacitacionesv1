<?php

namespace App\Filament\Admin\Resources\ProveedorResource\Pages;

use App\Filament\Admin\Resources\ProveedorResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProveedors extends ManageRecords
{
    protected static string $resource = ProveedorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
