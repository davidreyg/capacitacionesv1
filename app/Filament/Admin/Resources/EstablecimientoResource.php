<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EstablecimientoResource\Pages;
use App\Filament\Admin\Resources\EstablecimientoResource\RelationManagers;
use App\Models\Establecimiento;
use App\Models\Ubigeo\Departamento;
use App\Models\Ubigeo\Distrito;
use App\Models\Ubigeo\Provincia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class EstablecimientoResource extends Resource
{
    protected static ?string $model = Establecimiento::class;
    protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $navigationIcon = 'tabler-building-community';

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
                    ->live()
                    ->afterStateUpdated(fn(Forms\Set $set) => $set('parent_id', null))
                    ->required(),
                Forms\Components\Select::make('parent_id')
                    ->options(fn(Forms\Get $get) => Establecimiento::whereTipo(Establecimiento::obtenerPadre($get('tipo')))->pluck('nombre', 'id'))
                    ->label(fn(Forms\Get $get): string => Establecimiento::obtenerPadre($get('tipo')) ?? 'Empty')
                    ->hidden(fn(Forms\Get $get): bool => Establecimiento::obtenerPadre($get('tipo')) === null)
                    ->required(fn(Forms\Get $get): bool => Establecimiento::obtenerPadre($get('tipo')) !== null),
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
                Forms\Components\TextInput::make('correo')
                    ->maxLength(60),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->numeric(),
                Forms\Components\Hidden::make('parent_id'),
                Forms\Components\Select::make('departamento_id')
                    ->label('Departamento')
                    ->options(Departamento::pluck('name', 'id'))
                    ->live()
                    ->hint(new HtmlString(\Blade::render('<x-filament::loading-indicator class="h-5 w-5" wire:loading wire:target="data.departamento_id" />')))
                    ->searchable()
                    ->dehydrated()
                    ->afterStateUpdated(function (Forms\Set $set) {
                        $set('provincia_id', null);
                        $set('distrito_id', null);
                    }),
                Forms\Components\Select::make('provincia_id')
                    ->label('Provincia')
                    ->options(function (Forms\Get $get) {
                        return Provincia::where('departamento_id', $get('departamento_id'))->pluck('name', 'id');
                    })
                    ->live()
                    ->hint(new HtmlString(\Blade::render('<x-filament::loading-indicator class="h-5 w-5" wire:loading wire:target="data.provincia_id" />')))
                    ->searchable()
                    ->dehydrated()
                    ->afterStateUpdated(fn(Forms\Set $set) => $set('distrito_id', null)),
                Forms\Components\Select::make('distrito_id')
                    ->label('Distrito')
                    ->options(function (Forms\Get $get) {
                        return Distrito::where('provincia_id', $get('provincia_id'))->pluck('name', 'id');
                    })
                    ->searchable(),


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
                Tables\Actions\ActionGroup::make([
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
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEstablecimientos::route('/'),
            'create' => Pages\CreateEstablecimiento::route('/create'),
            'edit' => Pages\EditEstablecimiento::route('/{record}/edit'),
        ];
    }
}
