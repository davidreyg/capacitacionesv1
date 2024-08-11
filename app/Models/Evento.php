<?php

namespace App\Models;

use App\Actions\Evento\ProgramarEventoAutomatico;
use App\Jobs\FinalizarEventoJob;
use App\Jobs\IniciarEventoJob;
use App\States\Evento\Creado;
use App\States\Evento\EventoState;
use App\States\Solicitud\Solicitado;
use Carbon\Carbon;
use Illuminate\Bus\Dispatcher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;

class Evento extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory, HasStates;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'hora_fin',
        'fecha_orden_servicio',
        'lugar',
        'libre',
        'evaluacion_simple',
        'vacantes',
        'creditos',
        'numero_horas',
        'estado',
        'modalidad_id',
        'capacitacion_id',
        'proveedor_id',
        "oportunidad_id",
        "user_id",
        "reprogramador_id",
        "fecha_reprogramacion",
        "inicio_job_id",
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'estado' => EventoState::class,
        'evaluacion_simple' => 'boolean',
        'libre' => 'boolean',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reprogramador()
    {
        return $this->belongsTo(User::class, 'reprogramador_id');
    }

    public function capacitacion()
    {
        return $this->belongsTo(Capacitacion::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function oportunidad()
    {
        return $this->belongsTo(Oportunidad::class);
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

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class)->using(EmpleadoEvento::class);
    }

    public function sesions()
    {
        return $this->hasMany(Sesion::class);
    }

    public function solicituds()
    {
        return $this->hasMany(Solicitud::class);
    }

    public function criterioEvaluacions()
    {
        return $this->hasMany(CriterioEvaluacion::class);
    }

    /**
     * Solo es referencial ya que directamente no hay relacion entre el evento y las evaluaciones.
     * pero si desde criterioEvaluacions. :)
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     * @author David Rey Gutierrez
     * @copyright (c) 2024
     */
    public function evaluacions()
    {
        return $this->hasManyThrough(Evaluacion::class, CriterioEvaluacion::class);
    }

    /**
     * En caso de ser libre el curso devolvemos 0 en vacantes disponibles
     * @return int
     * @author David Rey Gutierrez
     * @copyright (c) 2024
     */
    public function getVacantesDisponiblesAttribute(): int
    {
        return ($this->libre || $this->vacantes === null) ? 0 : $this->vacantes - $this->empleados_count;
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Evento $evento) {
            ProgramarEventoAutomatico::make()->handle($evento);
        });

        static::deleting(function (Evento $evento) {

            \DB::table('jobs')->where('id', $evento->inicio_job_id)->delete();
            \DB::table('jobs')->where('id', $evento->fin_job_id)->delete();
            // Actualizar el estado de las solicitudes relacionadas

            $evento->solicituds->each(function (Solicitud $solicitud) {
                $solicitud->estado->transitionTo(Solicitado::class);
            });
        });
    }
}
