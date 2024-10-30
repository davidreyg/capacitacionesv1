<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DeclaracionPregunta extends Pivot
{
    public $timestamps = false;
    protected $table = 'declaracion_pregunta';
    protected $fillable = ['respuesta', 'pregunta_id'];

    public function declaracion()
    {
        return $this->belongsTo(Declaracion::class);
    }

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
