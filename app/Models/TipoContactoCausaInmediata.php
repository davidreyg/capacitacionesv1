<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TipoContactoCausaInmediata extends Pivot
{
    public $timestamps = false;
    protected $table = 'tipo_contacto_causa_inmediata';

    public function causaInmediata()
    {
        return $this->belongsTo(CausaInmediata::class);
    }

    public function tipoContacto()
    {
        return $this->belongsTo(TipoContacto::class);
    }
}
