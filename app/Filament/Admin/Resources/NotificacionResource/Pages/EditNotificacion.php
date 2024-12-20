<?php

namespace App\Filament\Admin\Resources\NotificacionResource\Pages;

use App\Filament\Admin\Resources\NotificacionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class EditNotificacion extends EditRecord
{
    use NestedPage;
    protected static string $resource = NotificacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
