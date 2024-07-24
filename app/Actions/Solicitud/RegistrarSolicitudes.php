<?php

namespace App\Actions\Solicitud;

use Lorisleiva\Actions\Concerns\AsAction;

class RegistrarSolicitudes
{
    use AsAction;

    public function handle(array $data, string $model)
    {
        foreach ($data['capacitacion_ids'] as $capacitacion) {
            $model::create([
                'establecimiento_id' => $data['establecimiento_id'],
                'capacitacion_id' => $capacitacion,
                'estado' => $data['estado'],
            ]);
        }
    }
}
