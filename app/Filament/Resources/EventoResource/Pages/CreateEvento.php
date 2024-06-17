<?php

namespace App\Filament\Resources\EventoResource\Pages;

use App\Filament\Resources\EventoResource;
use App\Models\Asignacion;
use App\Models\Evento;
use App\States\Asignacion\Aprobado;
use Filament\Resources\Pages\CreateRecord;

class CreateEvento extends CreateRecord
{
    protected static string $resource = EventoResource::class;
    protected ?bool $hasDatabaseTransactions = true;

    // TODO: Esto es peligroso
    protected function handleRecordCreation(array $data): Evento
    {
        $evento = static::getModel()::create($data);
        foreach ($data['asignacion_ids'] as $value) {
            $asignacion = Asignacion::find($value);
            $asignacion->evento_id = $evento->id;
            $asignacion->save();
            $asignacion->estado->transitionTo(Aprobado::class);
        }
        return $evento;
    }
}
