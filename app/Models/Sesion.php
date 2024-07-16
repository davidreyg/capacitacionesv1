<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sesion extends Model implements HasMedia
{
    use InteractsWithMedia;
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
