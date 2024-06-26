<?php

namespace App\Models;

use App\States\Evento\EventoState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Evento extends Model
{
    use HasFactory, HasStates;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'fecha_orden_servicio',
        'lugar',
        'libre',
        'vacantes',
        'estado',
        'modalidad_id',
        'capacitacion_id',
        'proveedor_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'estado' => EventoState::class,
    ];

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class);
    }

    public function capacitacion()
    {
        return $this->belongsTo(Capacitacion::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function costosDirectos()
    {
        return $this->hasMany(CostoEvento::class)->whereHas('costo', function ($q) {
            $q->where('tipo', 'directo');
        });
    }
    public function costosIndirectos()
    {
        return $this->hasMany(CostoEvento::class)->whereHas('costo', function ($q) {
            $q->where('tipo', 'indirecto');
        });
    }
    public function sesions()
    {
        return $this->hasMany(Sesion::class);
    }

    public function asignacions()
    {
        return $this->hasMany(Asignacion::class);
    }
}
