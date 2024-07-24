<?php

namespace App\Filament\Establecimiento\Resources\SesionResource\Pages;

use App\Filament\Establecimiento\Resources\SesionResource;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class ViewSesion extends ViewRecord
{
    use NestedPage;
    protected static string $resource = SesionResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Datos de la sesión')
                    ->description('Información general de la sesion.')
                    ->schema([
                        TextEntry::make('nombre'),
                        TextEntry::make('descripcion'),
                        TextEntry::make('fecha')->date(),
                        TextEntry::make('hora')->time(),
                    ])->columns(3),
                //TODO: Al cerrar la asistencia de la sesion se debe mostrar el usuario que registro la asistencia y su archivo
                Section::make('Evidencias de la sesión')
                    ->schema([
                        // FileViewer::make('silabo')->collection('silabo')->columnSpanFull()
                    ])->columns(3),

            ]);
    }
}
