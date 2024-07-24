<?php

namespace App\Filament\Establecimiento\Resources;

use App\Filament\Establecimiento\Resources\SesionResource\Pages;
use App\Filament\Establecimiento\Resources\SesionResource\RelationManagers;
use App\Models\Sesion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SesionResource extends Resource
{
    use NestedResource;
    protected static ?string $model = Sesion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                // Tables\Actions\EditAction::make(),
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
            // 'index' => Pages\ListSesions::route('/'),
            // 'create' => Pages\CreateSesion::route('/create'),
            'view' => Pages\ViewSesion::route('/{record}'),
            'asistencia' => Pages\RegistrarSesionAsistencia::route('/{record}/asistencia'),
        ];
    }

    public static function getAncestor(): ?Ancestor
    {
        return Ancestor::make(
            'sesions',
            'evento',
        );
    }
}
