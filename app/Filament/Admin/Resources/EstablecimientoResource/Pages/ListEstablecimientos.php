<?php

namespace App\Filament\Admin\Resources\EstablecimientoResource\Pages;

use App\Filament\Admin\Resources\EstablecimientoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstablecimientos extends ListRecords
{
    protected static string $resource = EstablecimientoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
