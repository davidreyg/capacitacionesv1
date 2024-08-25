<?php

namespace App\Filament\Admin\Resources\NotificacionResource\Table;

use App\Models\Notificacion;
use Filament\Tables\Columns\TextColumn;

class NotificacionTable
{
    public static function columns(): array
    {
        return [
            TextColumn::make('codigo')->wrap(),
            TextColumn::make('fecha')->date(),
            TextColumn::make('tipo_notificacion_verificado')
                ->label('Tipo de Notificacion (*)')
                ->badge(),
            TextColumn::make('estado')
                ->badge()
                ->formatStateUsing(fn(Notificacion $record): string => $record->estado->display())
                ->color(fn(Notificacion $record): string => $record->estado->color())
                ->icon(fn(Notificacion $record): string => $record->estado->icon()),
        ];
    }
}
