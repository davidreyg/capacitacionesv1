<?php

namespace App\Filament\Establecimiento\Resources\EventoResource\Pages;

use App\Filament\Establecimiento\Resources\EventoResource;
use App\Infolists\Components\FileViewer;
use Filament\Actions;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewEvento extends ViewRecord
{
    protected static string $resource = EventoResource::class;
    protected ?string $heading = 'Ver Evento';

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Datos del evento')
                    ->description('Información general del evento.')
                    ->schema([
                        TextEntry::make('modalidad.nombre'),
                        TextEntry::make('capacitacion.eje_tematico.nombre')
                            ->label('Eje Temático'),
                        TextEntry::make('capacitacion.nombre'),
                        TextEntry::make('estado')->badge(),
                        TextEntry::make('fecha_inicio')->date(),
                        TextEntry::make('hora_inicio')->time(),
                        TextEntry::make('proveedor.razon_social'),
                    ])->columns(3),
                Section::make('Recursos')
                    ->schema([
                        FileViewer::make('silabo')->collection('silabo')->columnSpanFull()
                    ])->columns(3),

            ]);
    }

    public static function getNavigationLabel(): string
    {
        return 'Ver Evento';
    }
}
