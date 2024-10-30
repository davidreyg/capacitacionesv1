<?php

namespace App\Filament\Admin\Resources\NotificacionResource\Pages;

use App\Filament\Admin\Resources\NotificacionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Guava\FilamentNestedResources\Pages\CreateRelatedRecord;

class CreateNotificacionDeclaracion extends CreateRelatedRecord
{
    use NestedPage;
    protected static string $resource = NotificacionResource::class;
    protected static string $relationship = 'declaracions';

    protected ?string $heading = 'Crear Declaración';
    protected static ?string $breadcrumb = 'Crear Declaración';

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? GestionarNotificacionDeclaraciones::getUrl(['record' => $this->getRecord()->notificacion]);
    }
}
