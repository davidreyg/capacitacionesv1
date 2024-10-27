<?php

namespace App\Models\AnexoUno;

use App\Enums\AnexoUno\TipoAnexoUno;
use App\Models\Empleado;
use App\Models\Establecimiento;
use App\Models\Notificacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnexoUno extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'fecha_presentacion',
        'establecimiento_empleador_id',
        'establecimiento_laboral_id',
        'empleado_id',
        'fecha_hora_accidente',
        'anexo_uno_forma_accidente_id',
        'anexo_uno_agente_causante_id',
        'accidente_centro_medico_nombre',
        'accidente_centro_medico_ruc',
        'accidente_fecha_ingreso',
        'anexo_uno_parte_afectada_id',
        'anexo_uno_naturaleza_lesion_id',
        'accidente_medico_nombre',
        'accidente_medico_numero_colegiatura',
        'anexo_uno_enfermedades_trabajo_id',
        'enfermedad_centro_medico_nombre',
        'enfermedad_centro_medico_ruc',
        'enfermedad_fecha_ingreso',
        'enfermedad_medico_nombre',
        'enfermedad_medico_numero_colegiatura',
        'notificacion_id',
    ];

    protected $casts = [
        'tipo' => TipoAnexoUno::class,
        'fecha_presentacion' => 'date',
    ];

    public function notificacion()
    {
        return $this->belongsTo(Notificacion::class);
    }

    public function establecimientoEmpleador()
    {
        return $this->belongsTo(Establecimiento::class, 'establecimiento_empleador_id');
    }

    public function establecimientoLaboral()
    {
        return $this->belongsTo(Establecimiento::class, 'establecimiento_laboral_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function consecuencias()
    {
        return $this->belongsToMany(Consecuencia::class);
    }

    public function riesgos()
    {
        return $this->belongsToMany(Riesgo::class);
    }
}
