<?php

namespace App\Filament\Admin\Resources\NotificacionResource\Pages;

use App\Enums\AnexoUno\TipoAnexoUno;
use App\Filament\Admin\Resources\NotificacionResource;
use App\Models\Establecimiento;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Enums\IconSize;
use Illuminate\Support\Str;
use JaOcero\RadioDeck\Forms\Components\RadioDeck;

class RegistrarAnexoUno extends EditRecord
{
    use EditRecord\Concerns\HasWizard;
    protected static string $resource = NotificacionResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Datos Generales')
                // ->description('Give the category a clear and unique name')
                ->schema([
                    RadioDeck::make('tipo')
                        ->options(TipoAnexoUno::class)
                        ->descriptions(TipoAnexoUno::class)
                        ->icons(TipoAnexoUno::class)
                        ->required()
                        ->iconSize(IconSize::Large)
                        ->iconPosition(IconPosition::Before)
                        ->alignment(Alignment::Center)
                        ->color('primary')
                        ->columns(2),
                    DatePicker::make('fecha_presentacion')
                        ->required(),
                ]),
            Step::make('Datos del empleador')
                ->description('Add some extra details')
                ->schema([
                    Select::make('empresa_empleador_id')
                        ->label('Empresa')
                        ->options(Establecimiento::where('parent_id', null)->pluck('nombre', 'id')),
                ]),
            Step::make('Visibility')
                ->description('Control who can view it')
                ->schema([
                    Toggle::make('is_visible')
                        ->label('Visible to customers.')
                        ->default(true),
                ]),
        ];
    }
}
