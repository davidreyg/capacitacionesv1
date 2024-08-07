<?php

namespace App\Filament\Admin\Resources\TipoDocumentoResource\Pages;

use App\Filament\Admin\Resources\TipoDocumentoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipoDocumentos extends ManageRecords
{
    protected static string $resource = TipoDocumentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
