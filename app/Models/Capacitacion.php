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
        "creditos",
        "numero_horas",
        "problema",
        "activo",
        "tipo_capacitacion_id",
        "eje_tematico_id",
        "oportunidad_id",
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
    public function oportunidad()
    {
        return $this->belongsTo(Oportunidad::class);
    }

    public function nivels()
    {
        return $this->belongsToMany(Nivel::class);
    }

    public function capacitacionRespuestas()
    {
        return $this->hasMany(CapacitacionRespuesta::class);
    }

    public function asignacions()
    {
        return $this->hasMany(Asignacion::class);
    }
}
