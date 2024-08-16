<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Empleado;
use App\Models\Evento;
use App\Models\Solicitud;
use App\States\Evento\Evaluado;
use App\States\Evento\Finalizado;
use App\States\Solicitud\Aprobado;
use App\States\Solicitud\Solicitado;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

// FIXME: Falta arreglar esto.
class StatsAdminOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('N° de Programaciones', Evento::count())
                // ->description('32k increase')
                // ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),

            Stat::make('N° de empleados', Empleado::count())
                ->color('success'),
            Stat::make('N° de empleados capacitados', Empleado::whereHas('eventos')->count())
                ->color('success'),


            Stat::make('N° cursos solicitados', Solicitud::count())
                ->description('')
                ->descriptionIcon('tabler-alert-circle')
                ->color('info'),
            Stat::make('N° cursos aprobados', Solicitud::whereNotState('estado', [Solicitado::class, Evaluado::class])->count())
                ->description('')
                ->descriptionIcon('tabler-alert-circle')
                ->color('info'),
            Stat::make('N° cursos finalizados', Solicitud::whereHas('evento', function (Builder $query) {
                $query->whereState('estado', Finalizado::class);
            })->count())
                ->description('')
                ->descriptionIcon('tabler-alert-circle')
                ->color('info'),
        ];
    }
}
