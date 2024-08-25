<?php

namespace App\Models\Laboratorio;

use App\Enums\Prueba\ResultadoEnum;
use App\Models\Empleado;
use App\Models\Laboratorio\Prueba;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EmpleadoPrueba extends Pivot
{
    protected $table = 'empleado_prueba';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha_resultado' => 'date',
        'fecha_aislamiento' => 'date',
        'resultado' => ResultadoEnum::class,
    ];
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
    public function prueba()
    {
        return $this->belongsTo(Prueba::class);
    }
}
