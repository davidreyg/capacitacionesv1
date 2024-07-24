<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TipoCapacitacionResource\Pages;
use App\Filament\Admin\Resources\TipoCapacitacionResource\RelationManagers;
use App\Models\TipoCapacitacion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoCapacitacionResource extends Resource
{
    protected static ?string $model = TipoCapacitacion::class;
    protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $modelLabel = 'Tipo de capacitación';
    protected static ?string $pluralModelLabel = 'Tipos de capacitación';
    protected static ?string $navigationIcon = 'tabler-books';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('nombre');
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTipoCapacitacions::route('/'),
        ];
    }
}
