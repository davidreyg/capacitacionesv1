<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Empleado;
use App\Models\Evento;
use App\Models\Solicitud;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

// FIXME: Falta arreglar esto.
class StatsAdminOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('N° de empleados', Empleado::count())
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('N° de Programaciones', Evento::count())
                // ->description('32k increase')
                // ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
            Stat::make('N° de Solicitudes', Solicitud::count())
                ->description('')
                ->descriptionIcon('tabler-alert-circle')
                ->color('info'),
        ];
    }
}
