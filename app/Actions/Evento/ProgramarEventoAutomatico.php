<?php


namespace App\Actions\Evento;

use App\Jobs\FinalizarEventoJob;
use App\Jobs\IniciarEventoJob;
use App\Models\Evento;
use App\Models\User;
use App\States\Evento\Creado;
use Carbon\Carbon;
use Illuminate\Bus\Dispatcher;
use Lorisleiva\Actions\Concerns\AsAction;

class ProgramarEventoAutomatico
{
    use AsAction;

    public function handle(Evento $evento, $deletePreviousJob = false)
    {
        $usersToNotify = User::with(['empleado.establecimiento'])
            ->whereHas('empleado.establecimiento', function (\Staudenmeir\LaravelAdjacencyList\Eloquent\Builder $query) {
                $query->where('tipo', config('app-establecimiento.tipo_establecimiento.DIRIS'));
            })
            ->get();
        // Solo se ejecutara el job si es que el evento esta CREADO si no simplemente no hacer nada.
        if (!$evento->estado->equals(Creado::class)) {
            return;
        }

        if ($deletePreviousJob) {
            \DB::table('jobs')->where('id', $evento->inicio_job_id)->delete();
            \DB::table('jobs')->where('id', $evento->fin_job_id)->delete();
            $evento->inicio_job_id = null;
            $evento->fin_job_id = null;
        }
        // Combinar fecha y hora para calcular el momento exacto
        $fechaHoraInicio = Carbon::parse($evento->fecha_inicio->format('Y-m-d') . ' ' . $evento->hora_inicio);
        $fechaHoraFin = Carbon::parse($evento->fecha_fin->format('Y-m-d') . ' ' . $evento->hora_fin);

        // Verifica que las fechas no sean en el pasado
        if ($fechaHoraInicio->isPast()) {
            \Log::error('La fecha de inicio está en el pasado. No se puede despachar el job.');
            return;
        }
        if ($fechaHoraFin->isPast()) {
            \Log::error('La fecha de fin está en el pasado. No se puede despachar el job.');
            return;
        }

        // Calcula el retraso en segundos hasta la fecha y hora de inicio
        $delay_inicio = $fechaHoraInicio->diffInSeconds(now());
        $delay_fin = $fechaHoraFin->diffInSeconds(now());

        // Despacha el job con el retraso
        $inicio_job = (new IniciarEventoJob($evento, $usersToNotify))->delay($delay_inicio);
        $inicio_id = app(Dispatcher::class)->dispatch($inicio_job);

        $fin_job = (new FinalizarEventoJob($evento, $usersToNotify))->delay($delay_fin);
        $fin_id = app(Dispatcher::class)->dispatch($fin_job);
        $evento->inicio_job_id = $inicio_id;
        $evento->fin_job_id = $fin_id;
        $evento->save();
    }
}
