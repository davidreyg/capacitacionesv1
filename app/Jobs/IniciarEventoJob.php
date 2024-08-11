<?php

namespace App\Jobs;

use App\Models\Evento;
use App\States\Evento\Iniciado;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Str;

class IniciarEventoJob implements ShouldQueue
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
            // Cambiar el estado del evento a "iniciado"
            $this->evento->estado->transitionTo(Iniciado::class);
            $this->evento->inicio_job_id = null;
            $this->evento->save();

            Notification::make()
                ->title(Str::markdown('Evento **INICIADO** correctamente.'))
                ->body(Str::markdown('*' . $this->evento->capacitacion->nombre . '*.'))
                ->success()
                ->sendToDatabase($this->users);
            foreach ($this->users as $user) {
                event(new DatabaseNotificationsSent($user));
            }
        });
    }

    public function failed(?\Throwable $exception): void
    {
        Notification::make()
            ->title('Error al iniciar el evento: ' . $this->evento->capacitacion->nombre . '.')
            ->danger()
            ->sendToDatabase($this->users);
        foreach ($this->users as $user) {
            event(new DatabaseNotificationsSent($user));
        }
    }
}
