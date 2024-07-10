<?php

namespace App\Filament\Resources\EventoResource\Pages;

use App\Filament\Resources\EventoResource;
use App\Models\Solicitud;
use App\States\Solicitud\Aprobado;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditEvento extends EditRecord
{

    protected ?string $heading = 'Reprogramar Evento';
    protected static string $resource = EventoResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['solicitud_ids'] = $this->getRecord()->solicituds()->pluck('id');
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['fecha_reprogramacion'] = now();
        $data['reprogramador_id'] = auth()->id();
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        foreach ($data['solicitud_ids'] as $value) {
            $solcitud = Solicitud::find($value);
            $solcitud->evento_id = $record->id;
            $solcitud->save();
            if ($solcitud->estado->canTransitionTo(Aprobado::class)) {
                $solcitud->estado->transitionTo(Aprobado::class);
            }
        }
        return $record;
    }
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
