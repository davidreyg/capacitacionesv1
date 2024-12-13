<?php
namespace App\Filament\Admin\Forms;
use Carbon\Carbon;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\HtmlString;

class IndicadoresForm
{
    public static function form(Collection $periodos): array
    {
        return [
            Section::make('Filtros')
                ->description('Seleccione el rango de periodos para generar el reporte...')
                ->headerActions([
                    Actions\Action::make('imprimir')
                        ->label('Imprimir')
                        ->icon('heroicon-o-printer')
                        ->extraAttributes([
                            // This is the 'ugly' part. Need to prevent the form from being submitted by default
                            // so instead we define a method we need to call and pass it to the wire:click attr
                            'wire:click.prevent' => 'submitForm',
                        ])
                        ->submit('indicador.form'),
                ])
                ->schema([
                    Fieldset::make('Inicio')
                        ->schema([
                            Select::make('añoInicio')
                                ->options(function () use ($periodos) {
                                    $anios = $periodos
                                        ->pluck('fecha') // Obtén solo la columna fecha
                                        ->mapWithKeys(function ($fecha) {
                                            return [$fecha->year => $fecha->year]; // Extrae el año usando Carbon
                                        })
                                        ->unique() // Asegura que los años sean únicos
                                        ->sort()
                                        ->toArray();
                                    return $anios;
                                })
                                ->required()
                                ->hint(new HtmlString(\Blade::render('<x-filament::loading-indicator class="h-5 w-5" wire:loading wire:target="data.añoInicio" />')))
                                ->afterStateUpdated(fn(Set $set) => $set('mesInicio', null))
                                ->live(),
                            Select::make('mesInicio')
                                ->required()
                                ->options(function (Get $get) use ($periodos) {
                                    return $periodos
                                        ->filter(function ($periodo) use ($get) {
                                            return $periodo->fecha->year == $get('añoInicio'); // Filtra por el año
                                        })
                                        ->pluck('fecha') // Obtén solo las fechas del año filtrado
                                        ->map(function ($fecha) {
                                            return $fecha->format('m');// Extrae el mes de cada fecha
                                        })
                                        ->unique() // Asegura que los meses sean únicos
                                        ->sort()   // Ordena los meses en orden ascendente
                                        ->mapWithKeys(function ($month) {
                                            return [$month => Carbon::create(null, $month)->monthName]; // Convierte a nombre de mes
                                        })
                                        ->toArray();
                                })
                        ])->columnSpan(1),
                    Fieldset::make('Fin')
                        ->schema([
                            Select::make('añoFin')
                                ->required()
                                ->options(function () use ($periodos) {
                                    $anios = $periodos
                                        ->pluck('fecha') // Obtén solo la columna fecha
                                        ->mapWithKeys(function ($fecha) {
                                            return [$fecha->year => $fecha->year]; // Extrae el año usando Carbon
                                        })
                                        ->unique() // Asegura que los años sean únicos
                                        ->sort()
                                        ->toArray();
                                    return $anios;
                                })
                                ->hint(new HtmlString(\Blade::render('<x-filament::loading-indicator class="h-5 w-5" wire:loading wire:target="data.añoFin" />')))
                                ->afterStateUpdated(fn(Set $set) => $set('mesFin', null))
                                ->live(),
                            Select::make('mesFin')
                                ->required()
                                ->options(function (Get $get) use ($periodos) {
                                    return $periodos
                                        ->filter(function ($periodo) use ($get) {
                                            return $periodo->fecha->year == $get('añoFin'); // Filtra por el año
                                        })
                                        ->pluck('fecha') // Obtén solo las fechas del año filtrado
                                        ->map(function ($fecha) {
                                            return $fecha->format('m');// Extrae el mes de cada fecha
                                        })
                                        ->unique() // Asegura que los meses sean únicos
                                        ->sort()   // Ordena los meses en orden ascendente
                                        ->mapWithKeys(function ($month) {
                                            return [$month => Carbon::create(null, $month)->monthName]; // Convierte a nombre de mes
                                        })
                                        ->toArray();
                                })
                        ])->columnSpan(1)
                ])
                ->columns(2)
        ];
    }
}
