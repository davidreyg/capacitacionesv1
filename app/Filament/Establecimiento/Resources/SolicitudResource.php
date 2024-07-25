<?php

namespace App\Filament\Establecimiento\Resources;

use App\Filament\Establecimiento\Resources\SolicitudResource\Pages;
use App\Models\Capacitacion;
use App\Models\Solicitud;
use App\Models\TipoCapacitacion;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SolicitudResource extends Resource
{
    protected static ?string $model = Solicitud::class;
    protected static ?string $pluralModelLabel = 'Mis Solicitudes';
    protected static ?string $navigationIcon = 'tabler-folder-open';

    //TODO: Arreglar el dehydrated o simplemente cambiar la logica de guardado
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('establecimiento_id')
                    ->default(auth()->user()->empleado->establecimiento->id)
                    ->relationship('establecimiento', 'nombre')
                    ->disabled()
                    ->dehydrated()
                    ->required()->columnSpanFull(),
                ...static::buildCheckboxLists(),
                Hidden::make('estado'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('capacitacion.nombre')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('establecimiento.nombre')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estado')
                    ->badge()
                    ->formatStateUsing(fn(Solicitud $record): string => $record->estado->display())
                    ->color(fn(Solicitud $record): string => $record->estado->color())
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->fromAuthEstablecimiento();
    }

    public static function buildCheckboxLists(): array
    {
        return \App\Filament\Admin\Resources\SolicitudResource::buildCheckboxLists();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSolicituds::route('/'),
        ];
    }
}
