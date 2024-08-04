<?php

namespace App\Filament\Establecimiento\Resources\NotificacionResource\Pages;

use App\Filament\Establecimiento\Resources\NotificacionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotificacion extends EditRecord
{
    protected static string $resource = NotificacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
