<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmpleadoResource\Pages;
use App\Filament\Admin\Resources\EmpleadoResource\RelationManagers;
use App\Models\Empleado;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmpleadoResource extends Resource
{
    protected static ?string $model = Empleado::class;
    protected static ?string $navigationGroup = 'Gestion de Empleados';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero_documento')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('nombres')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('apellido_paterno')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('apellido_materno')
                    ->required()
                    ->maxLength(100),
                Forms\Components\DatePicker::make('fecha_nacimiento')
                    ->required(),
                Forms\Components\DatePicker::make('fecha_alta')
                    ->required(),
                Forms\Components\TextInput::make('sexo')
                    ->required()
                    ->maxLength(1),
                Forms\Components\TextInput::make('plaza')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('viene_de')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(100),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->maxLength(100),
                Forms\Components\Select::make('establecimiento_id')
                    ->label('Establecimiento')
                    ->relationship('establecimiento', 'nombre')
                    ->required(),
                Forms\Components\Select::make('unidad_organica_id')
                    ->relationship('unidadOrganica', 'nombre')
                    ->required(),
                Forms\Components\Select::make('cargo_id')
                    ->relationship('cargo', 'nombre')
                    ->required(),
                Forms\Components\Select::make('tipo_planilla_id')
                    ->relationship('tipoPlanilla', 'nombre')
                    ->required(),
                Forms\Components\Select::make('condicion_id')
                    ->relationship('condicion', 'nombre')
                    ->required(),
                Forms\Components\Select::make('desplazamiento_id')
                    ->relationship('desplazamiento', 'nombre')
                    ->required(),
                Forms\Components\Select::make('regimen_laboral_id')
                    ->relationship('regimenLaboral', 'nombre')
                    ->required(),
                Forms\Components\Select::make('funcion_id')
                    ->relationship('funcion', 'nombre')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido_paterno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido_materno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_alta')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sexo'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListEmpleados::route('/'),
            'create' => Pages\CreateEmpleado::route('/create'),
            'edit' => Pages\EditEmpleado::route('/{record}/edit'),
        ];
    }
}
