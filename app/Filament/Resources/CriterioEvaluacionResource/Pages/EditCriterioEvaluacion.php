<?php

namespace App\Filament\Resources\CriterioEvaluacionResource\Pages;

use App\Filament\Resources\CriterioEvaluacionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class EditCriterioEvaluacion extends EditRecord
{
    use NestedPage;
    protected static string $resource = CriterioEvaluacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
