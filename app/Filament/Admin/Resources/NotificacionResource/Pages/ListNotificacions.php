<?php

namespace App\Filament\Admin\Resources\NotificacionResource\Pages;

use App\Filament\Admin\Resources\NotificacionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotificacions extends ListRecords
{
    protected static string $resource = NotificacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
