<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NivelResource\Pages;
use App\Filament\Resources\NivelResource\RelationManagers;
use App\Models\Nivel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NivelResource extends Resource
{
    protected static ?string $model = Nivel::class;
    protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $pluralModelLabel = 'Niveles';
    protected static ?string $navigationIcon = 'tabler-stack-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(50)
                    ->unique(ignoreRecord: true),
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
            'index' => Pages\ManageNivels::route('/'),
        ];
    }
}
