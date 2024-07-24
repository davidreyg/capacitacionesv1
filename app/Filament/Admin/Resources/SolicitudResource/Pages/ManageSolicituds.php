<?php

namespace App\Filament\Admin\Resources\SolicitudResource\Pages;

use App\Actions\Solicitud\RegistrarSolicitudes;
use App\Filament\Admin\Resources\SolicitudResource;
use App\Models\Solicitud;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSolicituds extends ManageRecords
{
    protected static string $resource = SolicitudResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->databaseTransaction()
                ->using(function (array $data, string $model): Solicitud {
                    RegistrarSolicitudes::make()->handle($data, $model);
                    return $model::make();
                })
        ];
    }
}
