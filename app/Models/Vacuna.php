<?php

namespace App\Models;

use App\Models\Empleado\EmpleadoVacuna;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacuna extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['codigo', 'nombre'];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class)
            ->withPivot([
                'fabricante_id',
                'estado',
                'dosis',
                'fecha_vacuna',
                'edad_atencion',
                'establecimiento',
                'lote_vacuna'
            ])
            ->withTimestamps()
            ->using(EmpleadoVacuna::class);
    }
}
