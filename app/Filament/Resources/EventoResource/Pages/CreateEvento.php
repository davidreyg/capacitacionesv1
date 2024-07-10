<?php

namespace App\Filament\Resources\EventoResource\Pages;

use App\Filament\Resources\EventoResource;
use App\Models\Solicitud;
use App\Models\Evento;
use App\States\Solicitud\Aprobado;
use Filament\Resources\Pages\CreateRecord;

class CreateEvento extends CreateRecord
{
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
            $solcitud->evento_id = $evento->id;
            $solcitud->save();
            $solcitud->estado->transitionTo(Aprobado::class);
        }
        return $evento;
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
