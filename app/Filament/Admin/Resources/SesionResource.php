<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EventoResource\Pages\CreateEventoSesion;
use App\Filament\Admin\Resources\SesionResource\Pages;
use App\Filament\Admin\Resources\SesionResource\RelationManagers;
use App\Models\Sesion;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Component;

class SesionResource extends Resource implements HasShieldPermissions
{
    use NestedResource;
    protected static ?string $model = Sesion::class;

    protected static ?string $navigationIcon = 'tabler-presentation';

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
                    ->afterOrEqual(function (?Sesion $record, Component $livewire) {
                        if ($record) {
                            return $record->evento->fecha_inicio;
                        } else {
                            return $livewire->getOwnerRecord()->fecha_inicio;
                        }
                    })
                    ->beforeOrEqual(function (?Sesion $record, Component $livewire) {
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
                SpatieMediaLibraryFileUpload::make('media')
                    ->label('Recursos')
                    // ->avatar()
                    ->collection('recursos')
                    ->multiple()
                    ->alignCenter()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('fecha')
                //     ->date()
                //     ->sortable(),
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
            'asistencia' => Pages\RegistrarSesionAsistencia::route('/{record}/asistencia'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return array_merge(
            config('filament-shield.permission_prefixes.resource'),
            [
                'attendance',
                'subir_recursos'
            ]
        );
    }

    public static function getAncestor(): ?Ancestor
    {
        return Ancestor::make(
            'sesions',
            'evento',
        );
    }
}
