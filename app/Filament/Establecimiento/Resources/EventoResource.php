<?php

namespace App\Filament\Establecimiento\Resources;

use App\Actions\Evento\InscribirEmpleados;
use App\Filament\Establecimiento\Resources\EventoResource\Pages;
use App\Filament\Establecimiento\Resources\EventoResource\RelationManagers;
use App\Models\Empleado;
use App\Models\Evento;
use App\States\Solicitud\Habilitado;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventoResource extends Resource
{
    use NestedResource;
    protected static ?string $model = Evento::class;
    protected static ?string $modelLabel = 'Mis eventos';
    protected static ?string $navigationIcon = 'tabler-calendar-event';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function canAccess(): bool
    {
        return static::can('viewOwn');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('capacitacion.nombre')->wrap()->searchable(),
                TextColumn::make('fecha_inicio')->date()->label('Fecha de Inicio')->searchable(),
                TextColumn::make('vacantes_disponibles')->label('Vacantes / Cupos disponibles ')
                    ->formatStateUsing(fn(Evento $record, string $state): string => $record->libre ? "Curso libre" : "  $record->vacantes / $state"),
                TextColumn::make('estado')
                    ->badge()
                    ->formatStateUsing(fn(Evento $record): string => $record->estado->display())
                    ->color(fn(Evento $record): string => $record->estado->color())
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('inscribirAlumnos')
                    ->visible(fn(Evento $record) => static::can('enrollStudents', $record))
                    ->fillForm(fn(Evento $record): array => [
                        'empleado_ids' => $record->empleados()->fromAuthEstablecimiento()->pluck('empleado_id'),
                    ])
                    ->form([
                        CheckboxList::make('empleado_ids')
                            ->label('Alumnos')
                            ->options(fn() => Empleado::fromAuthEstablecimiento()->pluck('nombres', 'id'))
                            ->searchable()
                            ->bulkToggleable()
                            ->required()
                            ->columns(2),
                    ])
                    ->databaseTransaction()
                    ->modalSubmitActionLabel('Confirmar inscripción')
                    ->action(function (Action $action, array $data, Evento $record): void {
                        // Obtener los IDs de empleados seleccionados
                        $empleadosSeleccionados = $data['empleado_ids'];
                        InscribirEmpleados::make()->handle($record, $empleadosSeleccionados, auth()->user()->empleado->establecimiento_id);
                    }),
            ])
            ->bulkActions([
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
            'index' => Pages\ListEventos::route('/'),
            'view' => Pages\ViewEvento::route('/{record}'),
            'sesions' => Pages\GestionarEventoSesions::route('/{record}/sesions'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount('empleados')
            ->whereHas('solicituds', function (Builder $query) {
                $query
                    ->fromAuthEstablecimiento()
                    ->whereState('estado', Habilitado::class);
            });
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewEvento::class,
            Pages\GestionarEventoSesions::class,
        ]);
    }

    public static function getAncestor(): ?Ancestor
    {
        return null;
    }
}
