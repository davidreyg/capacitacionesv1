<?php

namespace App\Filament\Admin\Resources\EstablecimientoResource\Forms;
use App\Actions\BuscarReniec;
use App\Models\AnexoUno\AnexoUnoActividadEconomica;
use App\Models\Establecimiento;
use App\Models\TipoDocumento;
use App\Models\Ubigeo\Departamento;
use App\Models\Ubigeo\Distrito;
use App\Models\Ubigeo\Provincia;
use Carbon\Carbon;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\HtmlString;
use Livewire\Component as Livewire;
class EstablecimientoForm
{
    public static function form(): array
    {
        return [
            Select::make('tipo')
                ->options([
                    'RIS' => 'RIS',
                    'DIRIS' => 'DIRIS',
                    'ESTABLECIMIENTO' => 'ESTABLECIMIENTO',
                ])
                ->live()
                ->afterStateUpdated(fn(Set $set) => $set('parent_id', null))
                ->required(),
            Select::make('parent_id')
                ->options(fn(Get $get) => Establecimiento::whereTipo(Establecimiento::obtenerPadre($get('tipo')))->pluck('nombre', 'id'))
                ->label(fn(Get $get): string => Establecimiento::obtenerPadre($get('tipo')) ?? 'Empty')
                ->hidden(fn(Get $get): bool => Establecimiento::obtenerPadre($get('tipo')) === null)
                ->required(fn(Get $get): bool => Establecimiento::obtenerPadre($get('tipo')) !== null),
            TextInput::make('nombre')
                ->required()
                ->maxLength(255),
            TextInput::make('codigo')
                ->required()
                ->numeric(),
            TextInput::make('direccion')
                ->maxLength(100),
            TextInput::make('categoria')
                ->maxLength(4),
            TextInput::make('ris')
                ->maxLength(60),
            TextInput::make('correo')
                ->maxLength(60),
            TextInput::make('telefono')
                ->tel()
                ->numeric(),
            Hidden::make('parent_id'),
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
            TextInput::make('ruc')
                ->numeric()
                ->required(),
            Select::make('anexo_uno_actividad_economica_id')
                ->label('Actividad Economica')
                ->options(AnexoUnoActividadEconomica::pluck('descripcion', 'id'))
                ->required(),


        ];
    }

}