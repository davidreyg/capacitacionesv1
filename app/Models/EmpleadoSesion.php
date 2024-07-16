<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmpleadoSesion extends Pivot
{
    public $timestamps = false;
    protected $table = 'empleado_sesion';
    protected $casts = [
        'is_present' => 'boolean',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
    public function sesion()
    {
        return $this->belongsTo(Sesion::class);
    }
}
