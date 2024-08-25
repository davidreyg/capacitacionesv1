<?php

namespace App\Models\Empleado;

use App\Enums\Vacuna\DosisEnum;
use App\Enums\Vacuna\EstadoVacunaEnum;
use App\Models\Empleado;
use App\Models\Vacuna;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EmpleadoVacuna extends Pivot
{
    protected $table = 'empleado_vacuna';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha_vacuna' => 'date',
        'estado' => EstadoVacunaEnum::class,
        'dosis' => DosisEnum::class,
    ];
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
    public function vacuna()
    {
        return $this->belongsTo(Vacuna::class);
    }
}
