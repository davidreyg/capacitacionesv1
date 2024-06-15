<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EjeTematicoResource\Pages;
use App\Filament\Resources\EjeTematicoResource\RelationManagers;
use App\Models\EjeTematico;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EjeTematicoResource extends Resource
{
    protected static ?string $model = EjeTematico::class;
    protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $modelLabel = 'Ejes Tematico';
    protected static ?string $navigationIcon = 'tabler-clipboard-list';

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
            'index' => Pages\ManageEjeTematicos::route('/'),
        ];
    }
}
