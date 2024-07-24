<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EvaluacionResource\Pages;
use App\Filament\Admin\Resources\EvaluacionResource\RelationManagers;
use App\Models\Evaluacion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EvaluacionResource extends Resource
{
    use NestedResource;
    protected static ?string $model = Evaluacion::class;

    protected static ?string $navigationIcon = 'tabler-school';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            // 'index' => Pages\ListEvaluacions::route('/'),
            // 'create' => Pages\CreateEvaluacion::route('/create'),
            'edit' => Pages\EditEvaluacion::route('/{record}/edit'),
        ];
    }

    public static function getAncestor(): ?Ancestor
    {
        return Ancestor::make(
            'evaluacions',
            'evento',
        );
    }
}
