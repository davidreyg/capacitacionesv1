<?php

namespace App\Filament\Admin\Clusters\CatalogoEmpleados\Resources\FuncionResource\Pages;

use App\Filament\Admin\Clusters\CatalogoEmpleados\Resources\FuncionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFuncions extends ManageRecords
{
    protected static string $resource = FuncionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
