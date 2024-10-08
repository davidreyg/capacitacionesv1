<?php

namespace App\Filament\Admin\Resources\EventoResource\Pages;

use App\Actions\Evento\ProgramarEventoAutomatico;
use App\Filament\Admin\Resources\EventoResource;
use App\Models\Solicitud;
use App\States\Solicitud\Aprobado;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Illuminate\Database\Eloquent\Model;

class EditEvento extends EditRecord
{
    use NestedPage;

    protected ?string $heading = 'Reprogramar Evento';
    protected static ?string $navigationLabel = 'Editar evento';

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
            if ($solcitud->estado->canTransitionTo(Aprobado::class, $record->id)) {
                $solcitud->estado->transitionTo(Aprobado::class, $record->id);
            }
        }
        ProgramarEventoAutomatico::make()->handle($record, true);
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
