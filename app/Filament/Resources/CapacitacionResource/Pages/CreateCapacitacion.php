<?php

namespace App\Filament\Resources\CapacitacionResource\Pages;

use App\Filament\Resources\CapacitacionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCapacitacion extends CreateRecord
{
    protected static string $resource = CapacitacionResource::class;
    protected ?bool $hasDatabaseTransactions = true;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
