<?php

namespace App\Filament\Resources\SolicitudResource\Pages;

use App\Filament\Resources\SolicitudResource;
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
                    foreach ($data['capacitacion_ids'] as $capacitacion) {
                        $model::create([
                            'establecimiento_id' => $data['establecimiento_id'],
                            'capacitacion_id' => $capacitacion,
                            'estado' => $data['estado'],
                        ]);
                    }
                    return $model::make();
                })
        ];
    }
}
