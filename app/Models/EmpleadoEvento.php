<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmpleadoEvento extends Pivot
{
    public $timestamps = false;
    protected $table = 'empleado_evento';
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
