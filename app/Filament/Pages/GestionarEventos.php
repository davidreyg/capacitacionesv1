<?php

namespace App\Filament\Pages;

use App\Models\Empleado;
use App\Models\Solicitud;
use App\States\Solicitud\Habilitado;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class GestionarEventos extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;
    protected static ?string $navigationIcon = 'tabler-calendar-event';
    protected ?string $subheading = 'En esta seccion puede inscribir y evaluar los eventos que han sido "HABILITADOS" por la DIRIS/RIS.';
    protected static string $view = 'filament.pages.gestionar-eventos';

    public function table(Table $table): Table
    {
        return $table
            ->query(Solicitud::query()
                ->whereState('estado', Habilitado::class)
                ->whereHas('evento')
                ->where('establecimiento_id', auth()->user()->establecimiento_id))
            ->columns([
                // TextColumn::make('establecimiento.nombre')->searchable(),
                Stack::make([
                    TextColumn::make('capacitacion.nombre')->searchable(),
                    TextColumn::make('evento.fecha_inicio')->label('Fecha de Inicio')->searchable(),
                    TextColumn::make('estado')
                        ->badge()
                        ->formatStateUsing(fn(Solicitud $record): string => $record->evento->estado->display())
                        ->color(fn(Solicitud $record): string => $record->evento->estado->color())
                        ->searchable(),
                ])

            ])
            ->filters([
            ])
            ->actions([
                Action::make('inscribirAlumnos')
                    ->fillForm(fn(Solicitud $record): array => [
                        'empleado_ids' => $record->evento->empleados->pluck('id'),
                    ])
                    ->form([
                        Repeater::make('empleado_ids')
                            ->addActionLabel('Añadir alumnos')
                            ->label('Alumnos')
                            ->simple(
                                Select::make('empleados')
                                    ->options(Empleado::whereEstablecimientoId(auth()->user()->establecimiento_id)->get()->pluck('nombres', 'id'))
                                    ->distinct()
                                    ->searchable()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->required()
                            )
                    ])
                    ->modalSubmitActionLabel('Guardar')
                    ->action(function (array $data, Solicitud $record): void {
                        $record->evento->empleados()->sync($data['empleado_ids']);
                        Notification::make()
                            ->title('Alumnos inscritos correctamente.')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                // ...
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ]);
        ;
    }
}
