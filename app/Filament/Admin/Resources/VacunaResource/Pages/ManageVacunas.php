<?php

namespace App\Filament\Admin\Resources\VacunaResource\Pages;

use App\Filament\Admin\Resources\VacunaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVacunas extends ManageRecords
{
    protected static string $resource = VacunaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
