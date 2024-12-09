<?php

namespace App\Filament\Admin\Resources\PeriodoResource\Pages;

use App\Filament\Admin\Resources\PeriodoResource;
use App\Models\Periodo;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Validation\ValidationException;

class ManagePeriodo extends ManageRecords
{
    protected static string $resource = PeriodoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->using(function (Actions\CreateAction $action, array $data, string $model): Periodo {
                    $data['fecha'] = "{$data['año']}-{$data['mes']}-01";
                    // Validar que la fecha sea única
                    if (Periodo::where('fecha', $data['fecha'])->exists()) {
                        Notification::make()
                            ->title('El mes seleccionado ya ha sido registrado para el periodo ' . $data['año'])
                            ->danger()
                            ->send();
                        $action->halt();
                    }
                    // unset($data['año'], $data['mes']); // Opcional: si no deseas guardar el año por separado
                    return $model::create($data);
                }),
        ];
    }
}
