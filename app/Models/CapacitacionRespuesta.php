<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CapacitacionRespuesta extends Pivot
{
    public $timestamps = false;
    protected $table = 'capacitacion_respuesta';
    public function capacitacion()
    {
        return $this->belongsTo(Capacitacion::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
