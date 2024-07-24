<?php

namespace App\Filament\Establecimiento\Resources\SolicitudResource\Pages;

use App\Actions\Solicitud\RegistrarSolicitudes;
use App\Filament\Establecimiento\Resources\SolicitudResource;
use App\Models\Solicitud;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Exceptions\Halt;

class ManageSolicituds extends ManageRecords
{
    protected static string $resource = SolicitudResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->databaseTransaction()
                ->using(function (array $data, string $model): Solicitud {
                    try {
                        RegistrarSolicitudes::make()->handle($data, $model);
                    } catch (\Throwable $th) {
                        Notification::make('error')
                            ->danger()
                            ->body($th->getMessage())
                            ->send();
                        throw new Halt($th->getMessage());
                    }
                    return $model::make();
                })
        ];
    }
}
