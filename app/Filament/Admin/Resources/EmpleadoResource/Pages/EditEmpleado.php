<?php

namespace App\Filament\Admin\Resources\EmpleadoResource\Pages;

use App\Filament\Admin\Resources\EmpleadoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmpleado extends EditRecord
{
    protected static string $resource = EmpleadoResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $provincia_id = self::getRecord()->distrito->provincia_id;
        $departamento_id = self::getRecord()->distrito->provincia->departamento_id;
        $data['provincia_id'] = $provincia_id;
        $data['departamento_id'] = $departamento_id;

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
