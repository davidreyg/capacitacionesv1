<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventoResource\Pages\CreateEventoSesion;
use App\Filament\Resources\SesionResource\Pages;
use App\Filament\Resources\SesionResource\RelationManagers;
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
use Livewire\Component;

class SesionResource extends Resource
{
    use NestedResource;
    protected static ?string $model = Sesion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(100),
                Forms\Components\Textarea::make('descripcion')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('fecha')
                    ->after(function (?Sesion $record, Component $livewire) {
                        if ($record) {
                            return $record->evento->fecha_inicio;
                        } else {
                            return $livewire->getOwnerRecord()->fecha_inicio;
                        }
                    })
                    ->before(function (?Sesion $record, Component $livewire) {
                        if ($record) {
                            return $record->evento->fecha_fin;
                        } else {
                            return $livewire->getOwnerRecord()->fecha_fin;
                        }
                    })
                    ->required(),
                Forms\Components\TimePicker::make('hora')
                    ->seconds(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hora'),
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
            // 'index' => Pages\ListSesions::route('/'),
            // 'create' => Pages\CreateSesion::route('/create'),
            'edit' => Pages\EditSesion::route('/{record}/edit'),
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
