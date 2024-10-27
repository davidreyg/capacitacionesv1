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
}
