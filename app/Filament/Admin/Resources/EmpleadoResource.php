<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmpleadoResource\Pages;
use App\Filament\Admin\Resources\EmpleadoResource\RelationManagers;
use App\Models\AnexoUno\AnexoUnoCategoriaTrabajador;
use App\Models\Empleado;
use App\Models\Ubigeo\Departamento;
use App\Models\Ubigeo\Distrito;
use App\Models\Ubigeo\Provincia;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

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
            Select::make('turno')
                ->options(['M' => 'Masculino', 'F' => 'Femenino'])
                ->required(),
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
            Select::make('anexo_uno_categoria_trabajador_id')
                ->options(AnexoUnoCategoriaTrabajador::pluck('descripcion', 'id'))
                ->required(),
            Toggle::make('asegurado')
                ->inline(false)
                ->required(),
            TextInput::make('essalud')
                ->required()
                ->maxLength(100),
            TextInput::make('eps')
                ->required()
                ->maxLength(100),
            TextInput::make('direccion')
                ->required()
                ->maxLength(100),
            TextInput::make('tiempo_experiencia')
                ->required()
                ->maxLength(100),
            TextInput::make('antiguedad_puesto')
                ->required()
                ->numeric()
                ->minValue(0)
                ->maxLength(100),
            Select::make('turno')
                ->options(['T' => 'Tarde', 'M' => 'Mañana'])
                ->required(),
            Select::make('departamento_id')
                ->label('Departamento')
                ->options(Departamento::pluck('nombre', 'id'))
                ->live()
                ->hint(new HtmlString(\Blade::render('<x-filament::loading-indicator class="h-5 w-5" wire:loading wire:target="data.departamento_id" />')))
                ->searchable()
                ->dehydrated()
                ->afterStateUpdated(function (Set $set) {
                    $set('provincia_id', null);
                    $set('distrito_id', null);
                }),
            Select::make('provincia_id')
                ->label('Provincia')
                ->options(function (Get $get) {
                    return Provincia::where('departamento_id', $get('departamento_id'))->pluck('nombre', 'id');
                })
                ->live()
                ->hint(new HtmlString(\Blade::render('<x-filament::loading-indicator class="h-5 w-5" wire:loading wire:target="data.provincia_id" />')))
                ->searchable()
                ->dehydrated()
                ->afterStateUpdated(fn(Set $set) => $set('distrito_id', null)),
            Select::make('distrito_id')
                ->label('Distrito')
                ->options(function (Get $get) {
                    return Distrito::where('provincia_id', $get('provincia_id'))->pluck('nombre', 'id');
                })
                ->searchable(),
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
            Pages\GestionarEmpleadoPruebas::class,
            Pages\GestionarEmpleadoVacunas::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmpleados::route('/'),
            'create' => Pages\CreateEmpleado::route('/create'),
            'edit' => Pages\EditEmpleado::route('/{record}/edit'),
            'patologias' => Pages\GestionarEmpleadoPatologias::route('/{record}/patologias'),
            'pruebas' => Pages\GestionarEmpleadoPruebas::route('/{record}/pruebas'),
            'vacunas' => Pages\GestionarEmpleadoVacunas::route('/{record}/vacunas'),
        ];
    }
}
