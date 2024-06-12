<?php

namespace App\Filament\Resources\EjeTematicoResource\Pages;

use App\Filament\Resources\EjeTematicoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEjeTematicos extends ManageRecords
{
    protected static string $resource = EjeTematicoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
