<?php

namespace App\Models;

use App\States\Solicitud\SolicitudState;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Solicitud extends Model
{
    use HasStates;
    public $timestamps = false;
    protected $fillable = ['establecimiento_id', 'capacitacion_id', 'estado'];
    protected $casts = [
        'estado' => SolicitudState::class,
    ];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }

    public function capacitacion()
    {
        return $this->belongsTo(Capacitacion::class);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    protected static function booted()
    {
        static::creating(function ($solicitud) {
            // Check if a solicitud with the same establecimiento_id and 'solicitado' state already exists
            $exists = self::where('establecimiento_id', $solicitud->establecimiento_id)
                ->where('capacitacion_id', $solicitud->capacitacion_id)
                ->where('estado', 'solicitado')
                ->exists();

            if ($exists) {
                throw new \Exception('Ya existe una solicitud de este curso para este establecimiento en estado "solicitado".');
            }
        });
    }
}
