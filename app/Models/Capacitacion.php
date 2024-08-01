<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    use HasFactory;
    protected $fillable = [
        "codigo",
        "nombre",
        "perfil",
        "objetivo_aprendizaje",
        "objetivo_desempeño",
        "problema",
        "activo",
        "tipo_capacitacion_id",
        "eje_tematico_id",
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function tipo_capacitacion()
    {
        return $this->belongsTo(TipoCapacitacion::class);
    }

    public function eje_tematico()
    {
        return $this->belongsTo(EjeTematico::class);
    }

    public function nivels()
    {
        return $this->belongsToMany(Nivel::class);
    }

    public function respuestas()
    {
        return $this->belongsToMany(Respuesta::class);
    }

    public function capacitacionRespuestas()
    {
        return $this->hasMany(CapacitacionRespuesta::class);
    }

    public function solicituds()
    {
        return $this->hasMany(Solicitud::class);
    }
}
