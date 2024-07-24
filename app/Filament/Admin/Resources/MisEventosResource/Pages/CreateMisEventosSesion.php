<?php

namespace App\Filament\Admin\Resources\MisEventosResource\Pages;

use App\Filament\Admin\Resources\EventoResource\Pages\CreateEventoSesion;
use App\Filament\Admin\Resources\MisEventosResource;

class CreateMisEventosSesion extends CreateEventoSesion
{
    protected static string $resource = MisEventosResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? GestionarMisEventosSesions::getUrl(['record' => $this->getRecord()->evento]);
    }
}
