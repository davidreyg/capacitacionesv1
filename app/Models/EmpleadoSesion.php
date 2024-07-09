<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmpleadoSesion extends Pivot
{
    public $timestamps = false;
    protected $table = 'empleado_sesion';
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
    public function sesion()
    {
        return $this->belongsTo(Sesion::class);
    }
}
