<?php

namespace App\Filament\Admin\Resources\NivelResource\Pages;

use App\Filament\Admin\Resources\NivelResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageNivels extends ManageRecords
{
    protected static string $resource = NivelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
