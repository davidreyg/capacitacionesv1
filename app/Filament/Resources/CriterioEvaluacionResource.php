<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CriterioEvaluacionResource\Pages;
use App\Filament\Resources\CriterioEvaluacionResource\RelationManagers;
use App\Models\CriterioEvaluacion;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CriterioEvaluacionResource extends Resource
{
    use NestedResource;
    protected static ?string $model = CriterioEvaluacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\TextColumn::make('porcentaje')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('evento_id')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            // 'index' => Pages\ListCriterioEvaluacions::route('/'),
            // 'create' => Pages\CreateCriterioEvaluacion::route('/create'),
            // 'edit' => Pages\EditCriterioEvaluacion::route('/{record}/edit'),
        ];
    }

    public static function getAncestor(): ?Ancestor
    {
        return Ancestor::make(
            'criterioEvaluacions',
            'evento',
        );
    }
}
