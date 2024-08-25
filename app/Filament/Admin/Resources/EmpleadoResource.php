<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmpleadoResource\Pages;
use App\Filament\Admin\Resources\EmpleadoResource\RelationManagers;
use App\Models\Empleado;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
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
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form->schema(self::empleadoForm());
    }

    public static function empleadoForm(): array
    {
        return [
            TextInput::make('numero_documento')
                ->required()
                ->numeric(),
            TextInput::make('nombres')
                ->required()
                ->maxLength(100),
            TextInput::make('apellido_paterno')
                ->required()
                ->maxLength(100),
            TextInput::make('apellido_materno')
                ->required()
                ->maxLength(100),
            DatePicker::make('fecha_nacimiento')
                ->required(),
            DatePicker::make('fecha_alta')
                ->required(),
            TextInput::make('sexo')
                ->required()
                ->maxLength(1),
            TextInput::make('plaza')
                ->required()
                ->numeric(),
            TextInput::make('viene_de')
                ->required()
                ->maxLength(100),
            TextInput::make('email')
                ->email()
                ->maxLength(100),
            TextInput::make('telefono')
                ->tel()
                ->maxLength(100),
            Select::make('establecimiento_id')
                ->label('Establecimiento')
                ->relationship('establecimiento', 'nombre')
                ->required(),
            Select::make('unidad_organica_id')
                ->relationship('unidadOrganica', 'nombre')
                ->required(),
            Select::make('cargo_id')
                ->relationship('cargo', 'nombre')
                ->required(),
            Select::make('tipo_planilla_id')
                ->relationship('tipoPlanilla', 'nombre')
                ->required(),
            Select::make('condicion_id')
                ->relationship('condicion', 'nombre')
                ->required(),
            Select::make('desplazamiento_id')
                ->relationship('desplazamiento', 'nombre')
                ->required(),
            Select::make('regimen_laboral_id')
                ->relationship('regimenLaboral', 'nombre')
                ->required(),
            Select::make('funcion_id')
                ->relationship('funcion', 'nombre')
                ->required(),
        ];
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

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\EditEmpleado::class,
            Pages\GestionarEmpleadoPatologias::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmpleados::route('/'),
            'create' => Pages\CreateEmpleado::route('/create'),
            'edit' => Pages\EditEmpleado::route('/{record}/edit'),
            'patologias' => Pages\GestionarEmpleadoPatologias::route('/{record}/patologias'),
        ];
    }
}
