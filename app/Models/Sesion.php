<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha',
        'hora',
        'evento_id',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class)->withPivot(['is_present'])->using(EmpleadoSesion::class);
    }
}
