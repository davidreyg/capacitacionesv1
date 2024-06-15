<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EstablecimientoEvento extends Pivot
{
    public $timestamps = false;
    protected $table = 'establecimiento_evento';
    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
