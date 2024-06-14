<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CostoEvento extends Pivot
{
    public $timestamps = false;
    protected $table = 'costo_evento';
    public function costo()
    {
        return $this->belongsTo(Costo::class);
    }
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
