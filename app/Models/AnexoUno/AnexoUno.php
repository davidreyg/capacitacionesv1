<?php

namespace App\Models\AnexoUno;

use App\Enums\AnexoUno\TipoAnexoUno;
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
    ];

    protected $casts = [
        'tipo' => TipoAnexoUno::class,
        'fecha_presentacion' => 'date',
    ];

    public function notificacion()
    {
        return $this->belongsTo(Notificacion::class);
    }
}
