<?php

namespace App\Filament\Admin\Resources\MisEventosResource\Pages;

use App\Filament\Admin\Resources\EventoResource\Pages\GestionarEventoSesions;
use App\Filament\Admin\Resources\MisEventosResource;
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
