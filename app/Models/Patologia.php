<?php

namespace App\Models;

use App\Models\Empleado\EmpleadoPatologia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patologia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre', 'descripcion'];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class)
            ->withPivot(['fecha_diagnostico', 'edad_diagnostico', 'tratamiento'])
            ->using(EmpleadoPatologia::class);
    }

}
