<?php

namespace App\Models\Empleado;

use App\Models\Empleado;
use App\Models\Patologia;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EmpleadoPatologia extends Pivot
{
    public $timestamps = false;
    protected $table = 'empleado_patologia';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha_diagnostico' => 'date',
    ];
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
    public function patologia()
    {
        return $this->belongsTo(Patologia::class);
    }
}
