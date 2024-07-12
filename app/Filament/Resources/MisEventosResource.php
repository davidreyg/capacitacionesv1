<?php

namespace App\Filament\Resources;

use App\Actions\Evento\InscribirEmpleados;
use App\Filament\Resources\MisEventosResource\Pages;
use App\Filament\Resources\MisEventosResource\Pages\GestionarSesiones;
use App\Filament\Resources\MisEventosResource\RelationManagers;
use App\Models\Empleado;
use App\Models\Evento;
use App\States\Solicitud\Habilitado;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MisEventosResource extends Resource
{
    protected static ?string $model = Evento::class;
    protected static ?string $modelLabel = 'Mis eventos';

    protected static ?string $navigationIcon = 'tabler-calendar-event';

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
                TextColumn::make('capacitacion.nombre')->searchable(),
                TextColumn::make('fecha_inicio')->label('Fecha de Inicio')->searchable(),
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
                    ->visible(fn() => auth()->user()->can('enroll_students_evento'))
                    ->fillForm(fn(Evento $record): array => [
                        'empleado_ids' => $record->empleados()->where('establecimiento_id', auth()->user()->establecimiento_id)->pluck('empleado_id'),
                    ])
                    ->form([
                        CheckboxList::make('empleado_ids')
                            ->label('Alumnos')
                            ->options(fn() => Empleado::whereEstablecimientoId(auth()->user()->establecimiento_id)->get()->pluck('nombres', 'id'))
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
                        InscribirEmpleados::make()->handle($record, $empleadosSeleccionados, auth()->user()->establecimiento_id);
                    }),
                Action::make('verSesiones')
                    ->visible(fn() => auth()->user()->can('view_any_sesion'))
                    ->url(fn(Evento $record): string => GestionarSesiones::getUrl(['record' => $record]))
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('solicituds', function (Builder $query) {
                $query
                    ->where('establecimiento_id', auth()->user()->establecimiento_id)
                    ->whereState('estado', Habilitado::class);
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMisEventos::route('/'),
            'sesions' => Pages\GestionarSesiones::route('/{record}/sesions'),
            // 'create' => Pages\CreateMisEventos::route('/create'),
            // 'edit' => Pages\EditMisEventos::route('/{record}/edit'),
        ];
    }
}
