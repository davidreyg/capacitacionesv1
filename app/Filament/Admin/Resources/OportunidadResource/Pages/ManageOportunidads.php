<?php

namespace App\Filament\Admin\Resources\OportunidadResource\Pages;

use App\Filament\Admin\Resources\OportunidadResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOportunidads extends ManageRecords
{
    protected static string $resource = OportunidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
