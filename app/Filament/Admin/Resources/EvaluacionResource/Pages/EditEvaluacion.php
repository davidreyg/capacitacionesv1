<?php

namespace App\Filament\Admin\Resources\EvaluacionResource\Pages;

use App\Filament\Admin\Resources\EvaluacionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class EditEvaluacion extends EditRecord
{
    use NestedPage;
    protected static string $resource = EvaluacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
