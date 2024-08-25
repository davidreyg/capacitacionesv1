<?php

namespace App\Filament\Admin\Resources\PatologiaResource\Pages;

use App\Filament\Admin\Resources\PatologiaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePatologias extends ManageRecords
{
    protected static string $resource = PatologiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
