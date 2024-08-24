<?php
namespace App\States\Notificacion;

use App\Models\Notificacion;
use Spatie\ModelStates\Transition;

class RegistradoToVerificado extends Transition
{
    private Notificacion $notificacion;
    private ?string $tipoNotificacionVerificado = null;

    public function __construct(Notificacion $notificacion, $tipoNotificacionVerificado)
    {
        $this->notificacion = $notificacion;
        $this->tipoNotificacionVerificado = $tipoNotificacionVerificado;
    }
    public function handle(): Notificacion
    {
        if (!$this->tipoNotificacionVerificado) {
            throw new \Exception('Para verificarse, debe proveer el tipo de notificacion.');
        }
        $this->notificacion->estado = new Verificado($this->notificacion);
        $this->notificacion->tipo_notificacion_verificado = $this->tipoNotificacionVerificado;
        $this->notificacion->save();

        return $this->notificacion;
    }
}
