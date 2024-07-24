<?php

namespace App\Filament\Admin\Resources\EventoResource\Pages;

use App\Filament\Admin\Resources\EventoResource;
use App\Models\Solicitud;
use App\Models\Evento;
use App\States\Solicitud\Aprobado;
use Filament\Resources\Pages\CreateRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class CreateEvento extends CreateRecord
{
    use NestedPage;
    protected static string $resource = EventoResource::class;
    protected ?bool $hasDatabaseTransactions = true;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }

    // TODO: Esto es peligroso
    protected function handleRecordCreation(array $data): Evento
    {
        $evento = static::getModel()::create($data);
        foreach ($data['solicitud_ids'] as $value) {
            $solcitud = Solicitud::find($value);
            $solcitud->estado->transitionTo(Aprobado::class, $evento->id);
        }
        return $evento;
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
