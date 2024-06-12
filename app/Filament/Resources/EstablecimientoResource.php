<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstablecimientoResource\Pages;
use App\Filament\Resources\EstablecimientoResource\RelationManagers;
use App\Models\Establecimiento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EstablecimientoResource extends Resource
{
    protected static ?string $model = Establecimiento::class;
    protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipo')
                    ->options([
                        'RIS' => 'RIS',
                        'DIRIS' => 'DIRIS',
                        'ESTABLECIMIENTO' => 'ESTABLECIMIENTO',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('parent_id')
                    ->numeric(),
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('direccion')
                    ->maxLength(100),
                Forms\Components\TextInput::make('categoria')
                    ->maxLength(4),
                Forms\Components\TextInput::make('ris')
                    ->maxLength(60),
                Forms\Components\TextInput::make('distrito')
                    ->maxLength(60),
                Forms\Components\TextInput::make('correo')
                    ->maxLength(60),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->numeric(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('codigo'),

                Tables\Columns\TextColumn::make('parent.nombre')
                    ->label('Padre'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ManageEstablecimientos::route('/'),
        ];
    }
}
