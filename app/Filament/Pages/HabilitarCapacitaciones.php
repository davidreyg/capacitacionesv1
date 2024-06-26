<?php

namespace App\Filament\Pages;

use App\Models\Asignacion;
use App\Models\Establecimiento;
use App\Models\EstablecimientoEvento;
use App\Models\Evento;
use App\States\Asignacion\Aprobado;
use App\States\Asignacion\Evaluado;
use App\States\Asignacion\Habilitado;
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

class HabilitarCapacitaciones extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.habilitar-capacitaciones';

    public array $establecimiento_ids;

    public function mount()
    {
        $this->establecimiento_ids = auth()->user()->establecimiento->tipo === config('appSection-establecimiento.tipo_establecimiento.RIS')
            ? auth()->user()->establecimiento->children()->pluck('id')->toArray()
            : auth()->user()->establecimiento->childrenAndSelf()->pluck('id')->toArray();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Asignacion::query()->whereHas('evento')->whereIn('establecimiento_id', $this->establecimiento_ids))
            ->columns([
                TextColumn::make('establecimiento.nombre')->searchable(),
                TextColumn::make('evento.capacitacion.nombre')->searchable(),
                TextColumn::make('evento.fecha_inicio')->searchable(),
                TextColumn::make('estado')
                    ->badge()
                    ->formatStateUsing(fn(Asignacion $record): string => $record->estado->display())
                    ->color(fn(Asignacion $record): string => $record->estado->color())
                    ->searchable(),

            ])
            ->filters([
            ])
            ->actions([

                Action::make('Aprobar')
                    ->hiddenLabel()
                    ->iconSize(IconSize::Large)
                    ->tooltip('Aprobar')
                    ->visible(fn(Asignacion $record): bool => $record->estado->canTransitionTo(Aprobado::class))
                    ->color('info')
                    ->icon('tabler-file-like')
                    ->requiresConfirmation()
                    ->action(fn(Asignacion $record): string => $record->estado->transitionTo(Aprobado::class)),
                Action::make('Habilitar')
                    ->hiddenLabel()
                    ->iconSize(IconSize::Large)
                    ->tooltip('Habilitar')
                    ->visible(fn(Asignacion $record): bool => $record->estado->canTransitionTo(Habilitado::class))
                    ->color('success')
                    ->icon('tabler-file-smile')
                    ->requiresConfirmation()
                    ->action(fn(Asignacion $record): string => $record->estado->transitionTo(Habilitado::class)),
                Action::make('Evaluar')
                    ->hiddenLabel()
                    ->iconSize(IconSize::Large)
                    ->tooltip('Evaluar')
                    ->visible(fn(Asignacion $record): bool => $record->estado->canTransitionTo(Evaluado::class))
                    ->color('danger')
                    ->icon('tabler-file-dislike')
                    ->requiresConfirmation()
                    ->action(fn(Asignacion $record): string => $record->estado->transitionTo(Evaluado::class)),

            ])
            ->bulkActions([
                // ...
            ])->defaultSort('estado');
    }
}
