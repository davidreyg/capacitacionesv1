<?php

namespace App\Filament\Resources\EstablecimientoResource\Pages;

use App\Filament\Resources\EstablecimientoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEstablecimientos extends ManageRecords
{
    protected static string $resource = EstablecimientoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
