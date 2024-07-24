<?php

namespace App\Filament\Admin\Resources\RespuestaResource\Pages;

use App\Filament\Admin\Resources\RespuestaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRespuestas extends ManageRecords
{
    protected static string $resource = RespuestaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
