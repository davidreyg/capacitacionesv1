<?php

namespace App\Models\Laboratorio;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre'];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class)
            ->withPivot([
                'metodo_prueba_id',
                'fecha_resultado',
                'fecha_aislamiento',
                'resultado',
                'dias_aislamiento',
                'observaciones'
            ])
            ->withTimestamps()
            ->using(EmpleadoPrueba::class);
    }
}
