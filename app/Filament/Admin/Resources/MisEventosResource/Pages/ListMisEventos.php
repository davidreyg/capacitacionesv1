<?php

namespace App\Filament\Admin\Resources\MisEventosResource\Pages;

use App\Filament\Admin\Resources\MisEventosResource;
use Filament\Resources\Pages\ListRecords;

class ListMisEventos extends ListRecords
{
    protected static string $resource = MisEventosResource::class;
    protected ?string $subheading = 'En esta seccion puede ver los eventos disponibles para su establecimiento.';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
