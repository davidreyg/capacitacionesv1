<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;
    protected $fillable = ['criterio_evaluacion_id', 'empleado_id', 'nota'];

    public function criterioEvaluacion()
    {
        return $this->belongsTo(CriterioEvaluacion::class);
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
