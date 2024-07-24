<?php

namespace App\Filament\Admin\Resources\EventoResource\Pages;

use App\Filament\Admin\Resources\EventoResource;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Guava\FilamentNestedResources\Pages\CreateRelatedRecord;

class CreateEventoSesion extends CreateRelatedRecord
{
    use NestedPage;
    protected static string $resource = EventoResource::class;
    protected static string $relationship = 'sesions';

    protected ?string $heading = 'Crear Sesión';
    protected static ?string $breadcrumb = 'Crear Sesión';

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? GestionarEventoSesions::getUrl(['record' => $this->getRecord()->evento]);
    }
}
