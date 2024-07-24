<?php

namespace App\Filament\Admin\Resources\SesionResource\Pages;

use App\Filament\Admin\Resources\SesionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class EditSesion extends EditRecord
{
    use NestedPage;
    protected static string $resource = SesionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
