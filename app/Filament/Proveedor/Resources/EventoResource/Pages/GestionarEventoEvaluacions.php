<?php

namespace App\Filament\Proveedor\Resources\EventoResource\Pages;

use App\Filament\Proveedor\Resources\EventoResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class GestionarEventoEvaluacions extends \App\Filament\Admin\Resources\EventoResource\Pages\GestionarEventoEvaluacions
{
    use InteractsWithRecord;
    protected static string $resource = EventoResource::class;
}
