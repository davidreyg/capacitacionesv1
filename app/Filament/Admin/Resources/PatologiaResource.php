<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PatologiaResource\Pages;
use App\Filament\Admin\Resources\PatologiaResource\RelationManagers;
use App\Models\Patologia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatologiaResource extends Resource
{
    protected static ?string $model = Patologia::class;
    protected static ?string $navigationGroup = 'Gestion de Empleados';
    protected static ?string $navigationIcon = 'tabler-disabled';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::patologiaForm());
    }

    public static function patologiaForm(): array
    {
        return [
            Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(100),
            Forms\Components\TextInput::make('descripcion')
                ->maxLength(200)
                ->default(null),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePatologias::route('/'),
        ];
    }
}
