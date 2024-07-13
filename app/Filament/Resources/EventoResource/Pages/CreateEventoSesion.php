<?php

namespace App\Filament\Resources\EventoResource\Pages;

use App\Filament\Resources\EventoResource;
use App\Models\Solicitud;
use App\Models\Evento;
use App\States\Solicitud\Aprobado;
use Filament\Resources\Pages\CreateRecord;
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
