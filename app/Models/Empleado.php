<?php

namespace App\Models;

use App\Models\Empleado\EmpleadoPatologia;
use App\Models\Empleado\EmpleadoVacuna;
use App\Models\Laboratorio\EmpleadoPrueba;
use App\Models\Laboratorio\Prueba;
use App\Traits\IsEstablecimientoOwned;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    use IsEstablecimientoOwned;

    protected $fillable = [
        'numero_documento',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'fecha_alta',
        'sexo',
        'plaza',
        'viene_de',
        'email',
        'telefono',
        'direccion',
        'asegurado',
        'eps',
        'essalud',
        'antiguedad_puesto',
        'turno',
        'tiempo_experiencia',
        'anexo_uno_categoria_trabajador_id',
        'establecimiento_id',
        'unidad_organica_id',
        'cargo_id',
        'tipo_planilla_id',
        'condicion_id',
        'desplazamiento_id',
        'regimen_laboral_id',
        'funcion_id',
    ];

    public function getNombreCompletoAttribute(): string
    {
        return "$this->apellido_paterno $this->apellido_materno, $this->nombres";
    }

    // Relaciones
    public function unidadOrganica()
    {
        return $this->belongsTo(UnidadOrganica::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function tipoPlanilla()
    {
        return $this->belongsTo(TipoPlanilla::class);
    }

    public function condicion()
    {
        return $this->belongsTo(Condicion::class);
    }

    public function desplazamiento()
    {
        return $this->belongsTo(Desplazamiento::class);
    }

    public function regimenLaboral()
    {
        return $this->belongsTo(RegimenLaboral::class);
    }

    public function funcion()
    {
        return $this->belongsTo(Funcion::class);
    }

    public function eventos()
    {
        return $this->belongsToMany(Evento::class)->using(EmpleadoEvento::class);
    }

    public function evaluacions()
    {
        return $this->hasMany(Evaluacion::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function patologias()
    {
        return $this->belongsToMany(Patologia::class)
            ->withPivot(['fecha_diagnostico', 'edad_diagnostico', 'tratamiento'])
            ->using(EmpleadoPatologia::class);
    }

    public function pruebas()
    {
        return $this->belongsToMany(Prueba::class)
            ->withPivot([
                'metodo_prueba_id',
                'fecha_resultado',
                'fecha_aislamiento',
                'resultado',
                'dias_aislamiento',
                'observaciones'
            ])
            ->withTimestamps()
            ->using(EmpleadoPrueba::class);
    }

    public function vacunas()
    {
        return $this->belongsToMany(Vacuna::class)
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
