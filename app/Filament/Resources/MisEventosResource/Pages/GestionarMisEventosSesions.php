<?php

namespace App\Filament\Resources\MisEventosResource\Pages;

use App\Filament\Resources\EventoResource\Pages\GestionarEventoSesions;
use App\Filament\Resources\MisEventosResource;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Actions\CreateAction;

class GestionarMisEventosSesions extends GestionarEventoSesions
{
    protected static string $resource = MisEventosResource::class;
    protected function configureCreateAction(CreateAction $action): void
    {
        ManageRelatedRecords::configureCreateAction(
            $action->url(
                fn() => MisEventosResource::getUrl("sesions.create", [
                    'record' => $this->getOwnerRecord(),
                ])
            )
        );
    }
}
