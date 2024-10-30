<?php

namespace App\Filament\Admin\Resources\DeclaracionResource\Pages;

use App\Filament\Admin\Resources\DeclaracionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class EditDeclaracion extends EditRecord
{
    use NestedPage;
    protected static string $resource = DeclaracionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
