<?php

namespace App\Models;

use App\States\Solicitud\SolicitudState;
use App\Traits\CheckUserType;
use App\Traits\IsEstablecimientoOwned;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Solicitud extends Model
{
    use HasStates;
    use CheckUserType, IsEstablecimientoOwned;
    public $timestamps = false;
    protected $fillable = ['establecimiento_id', 'capacitacion_id', 'estado'];
    protected $casts = [
        'estado' => SolicitudState::class,
    ];

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

    // SCOPES
    public function scopeEstablecimientoManageable(Builder $query): void
    {
        // Verificar si es empleado
        if ($this->isEmpleado()) {
            $user = $this->getUser()->loadMissing(['empleado', 'empleado.establecimiento']);
            $empleado = $user->empleado;

            $establecimiento = $empleado->establecimiento;
            $establecimientoIds = match (true) {
                // Es DIRIS
                $establecimiento->parent_id === null &&
                $establecimiento->tipo === config('app-establecimiento.tipo_establecimiento.DIRIS') => Establecimiento::pluck('id')->toArray(),
                // Es RIS
                $establecimiento->parent &&
                $establecimiento->parent->parent_id === null &&
                $establecimiento->tipo === config('app-establecimiento.tipo_establecimiento.RIS') => Establecimiento::where('parent_id', $establecimiento->id)
                    ->pluck('id')
                    ->toArray(),
                // Es ESTABLECIMIENTO
                default => [$establecimiento->id],
            };
            $query->whereIn('establecimiento_id', $establecimientoIds);
        }
    }
}
