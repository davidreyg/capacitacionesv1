<?php

namespace App\Filament\Pages;

use App\Models\Solicitud;
use App\States\Solicitud\Aprobado;
use App\States\Solicitud\Evaluado;
use App\States\Solicitud\Habilitado;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
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

    public array $establecimiento_ids;

    public function mount()
    {
        $this->establecimiento_ids = auth()->user()->establecimiento->tipo === config('appSection-establecimiento.tipo_establecimiento.DIRIS')
            ? auth()->user()->establecimiento->descendantsAndSelf()->pluck('id')->toArray()
            : auth()->user()->establecimiento->children()->pluck('id')->toArray();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Solicitud::query()->whereHas('evento')->whereIn('establecimiento_id', $this->establecimiento_ids))
            ->columns([
                TextColumn::make('establecimiento.nombre')->searchable(),
                TextColumn::make('evento.capacitacion.nombre')->searchable(),
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
                    ->tooltip('Aprobar')
                    ->visible(fn(Solicitud $record): bool => $record->estado->canTransitionTo(Aprobado::class))
                    ->color('info')
                    ->icon('tabler-file-like')
                    ->requiresConfirmation()
                    ->action(fn(Solicitud $record): string => $record->estado->transitionTo(Aprobado::class)),
                Action::make('Habilitar')
                    ->hiddenLabel()
                    ->iconSize(IconSize::Large)
                    ->tooltip('Habilitar')
                    ->visible(fn(Solicitud $record): bool => $record->estado->canTransitionTo(Habilitado::class))
                    ->color('success')
                    ->icon('tabler-file-smile')
                    ->requiresConfirmation()
                    ->action(fn(Solicitud $record): string => $record->estado->transitionTo(Habilitado::class)),
                Action::make('Evaluar')
                    ->hiddenLabel()
                    ->iconSize(IconSize::Large)
                    ->tooltip('Evaluar')
                    ->visible(fn(Solicitud $record): bool => $record->estado->canTransitionTo(Evaluado::class))
                    ->color('danger')
                    ->icon('tabler-file-dislike')
                    ->requiresConfirmation()
                    ->action(fn(Solicitud $record): string => $record->estado->transitionTo(Evaluado::class)),

            ])
            ->bulkActions([
                // ...
            ])->defaultSort('estado');
    }
}
