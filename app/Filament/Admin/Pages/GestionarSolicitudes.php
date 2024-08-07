<?php

namespace App\Filament\Admin\Pages;

use App\Models\Solicitud;
use App\States\Solicitud\Aprobado;
use App\States\Solicitud\Evaluado;
use App\States\Solicitud\Habilitado;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\IconSize;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class GestionarSolicitudes extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected ?string $subheading = 'Se muestran las solicitudes aprobadas y asignadas a un evento.';
    protected static string $view = 'filament.pages.gestionar-solicitudes';


    public function table(Table $table): Table
    {
        return $table
            ->query(Solicitud::query()->establecimientoManageable())
            ->columns([
                TextColumn::make('establecimiento.nombre')->searchable(),
                TextColumn::make('capacitacion.nombre')->wrap()->searchable(),
                TextColumn::make('evento.fecha_inicio')->searchable(),
                TextColumn::make('estado')
                    ->badge()
                    ->formatStateUsing(fn(Solicitud $record): string => $record->estado->display())
                    ->color(fn(Solicitud $record): string => $record->estado->color())
                    ->searchable(),

            ])
            ->filters([
            ])
            ->actions([

                Action::make('Aprobar')
                    ->hiddenLabel()
                    ->iconSize(IconSize::Large)
                    ->tooltip(fn(Solicitud $record): string => (new Aprobado($record))->action())
                    ->visible(fn(Solicitud $record): bool => $record->estado->canTransitionTo(Aprobado::class, null))
                    ->color(fn(Solicitud $record): string => (new Aprobado($record))->color())
                    ->icon(fn(Solicitud $record): string => (new Aprobado($record))->icon())
                    ->requiresConfirmation()
                    ->action(function (Solicitud $record) {
                        try {
                            $record->estado->transitionTo(Aprobado::class, null);
                        } catch (\Throwable $th) {
                            Notification::make('Error')
                                ->danger()
                                ->body($th->getMessage())
                                ->send();
                        }
                    }),
                Action::make('Habilitar')
                    ->hiddenLabel()
                    ->iconSize(IconSize::Large)
                    ->tooltip(fn(Solicitud $record): string => (new Habilitado($record))->action())
                    ->visible(fn(Solicitud $record): bool => $record->estado->canTransitionTo(Habilitado::class))
                    ->color(fn(Solicitud $record): string => (new Habilitado($record))->color())
                    ->icon(fn(Solicitud $record): string => (new Habilitado($record))->icon())
                    ->requiresConfirmation()
                    ->action(fn(Solicitud $record): string => $record->estado->transitionTo(Habilitado::class)),
                Action::make('Evaluar')
                    ->hiddenLabel()
                    ->iconSize(IconSize::Large)
                    ->tooltip(fn(Solicitud $record): string => (new Evaluado($record))->action())
                    ->visible(fn(Solicitud $record): bool => $record->estado->canTransitionTo(Evaluado::class))
                    ->color(fn(Solicitud $record): string => (new Evaluado($record))->color())
                    ->icon(fn(Solicitud $record): string => (new Evaluado($record))->icon())
                    ->requiresConfirmation()
                    ->action(fn(Solicitud $record): string => $record->estado->transitionTo(Evaluado::class)),

            ])
            ->bulkActions([
                // ...
            ])->defaultSort('estado');
    }
}
