<?php

namespace App\Filament\Admin\Resources\EmpleadoResource\Pages;

use App\Filament\Admin\Resources\EmpleadoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmpleados extends ListRecords
{
    protected static string $resource = EmpleadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
