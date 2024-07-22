<?php
namespace App\States\Solicitud;

use App\Models\Solicitud;
use Spatie\ModelStates\Transition;

class SolicitadoToAprobado extends Transition
{
    private Solicitud $solicitud;

    private ?int $eventoId;

    public function __construct(Solicitud $solicitud, ?int $eventoId)
    {
        $this->solicitud = $solicitud;

        $this->eventoId = $eventoId;
    }
    public function handle(): Solicitud
    {
        if (!$this->eventoId) {
            throw new \Exception('Para aprobarse, debe asignarse a un evento.');
        }
        $this->solicitud->evento_id = $this->eventoId;
        $this->solicitud->estado = new Aprobado($this->solicitud);
        $this->solicitud->save();

        return $this->solicitud;
    }
}
