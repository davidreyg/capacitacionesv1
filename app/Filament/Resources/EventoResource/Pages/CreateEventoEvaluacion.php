<?php

namespace App\Filament\Resources\EventoResource\Pages;

use App\Filament\Resources\EventoResource;
use App\Models\Solicitud;
use App\Models\Evento;
use App\States\Solicitud\Aprobado;
use Filament\Resources\Pages\CreateRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Guava\FilamentNestedResources\Pages\CreateRelatedRecord;

class CreateEventoEvaluacion extends CreateRelatedRecord
{
    use NestedPage;
    protected static string $resource = EventoResource::class;
    protected static string $relationship = 'evaluacions';

    protected ?string $heading = 'Crear Evaluacion';
    protected static ?string $breadcrumb = 'Crear Evaluacion';

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? GestionarEventoEvaluacions::getUrl(['record' => $this->getRecord()->evento]);
    }
}
