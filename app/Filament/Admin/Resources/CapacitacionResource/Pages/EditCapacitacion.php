<?php

namespace App\Filament\Admin\Resources\CapacitacionResource\Pages;

use App\Filament\Admin\Resources\CapacitacionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCapacitacion extends EditRecord
{
    protected static string $resource = CapacitacionResource::class;
    protected ?bool $hasDatabaseTransactions = true;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
