<?php

namespace App\Jobs;

use App\Models\Evento;
use App\States\Evento\Iniciado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProgramarInicioEventoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $evento;
    /**
     * Create a new job instance.
     */
    public function __construct(Evento $evento)
    {
        $this->evento = $evento->withoutRelations();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Cambiar el estado del evento a "iniciado"
        $this->evento->estado->transitionTo(Iniciado::class);
        $this->evento->job_id = null;
        $this->evento->save();
    }
}
