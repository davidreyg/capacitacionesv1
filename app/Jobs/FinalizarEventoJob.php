<?php

namespace App\Jobs;

use App\Models\Evento;
use App\Models\User;
use App\States\Evento\Finalizado;
use App\States\Evento\Iniciado;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class FinalizarEventoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Evento $evento;
    protected Collection $users;
    /**
     * Create a new job instance.
     */
    public function __construct(Evento $evento, Collection $users)
    {
        $this->evento = $evento->withoutRelations()->load('capacitacion');
        $this->users = $users;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \DB::transaction(function () {
            // Cambiar el estado del evento a "finalizado"
            $this->evento->estado->transitionTo(Finalizado::class);
            $this->evento->fin_job_id = null;
            $this->evento->save();

            Notification::make()
                ->title('El evento: ' . $this->evento->capacitacion->nombre . ' ha finalizado correctamente.')
                ->success()
                ->sendToDatabase($this->users);
            foreach ($this->users as $user) {
                \Log::info('Usuario' . $user->username . 'notificado perteneciente a: ' . $user->empleado->establecimiento);
                event(new DatabaseNotificationsSent($user));
            }
        });
    }

    public function failed(?\Throwable $exception): void
    {
        Notification::make()
            ->title('Error al finalizar el evento: ' . $this->evento->capacitacion->nombre . '.')
            ->danger()
            ->sendToDatabase($this->users);
        foreach ($this->users as $user) {
            event(new DatabaseNotificationsSent($user));
        }
    }
}
