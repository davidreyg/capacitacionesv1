<?php

namespace App\Filament\Admin\Resources\DeclaracionResource\Pages;

use App\Filament\Admin\Resources\DeclaracionResource;
use App\Models\Declaracion;
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
            Actions\Action::make('imprimir')
                ->label('Imprimir')
                ->icon('heroicon-o-printer')
                ->url(fn(Declaracion $record): string => route('declaracion-pdf', [
                    'id' => $record->id
                ]))
                ->openUrlInNewTab(),
        ];
    }
}
