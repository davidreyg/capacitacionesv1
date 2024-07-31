<?php

namespace App\Models;

use App\Enums\Notificacion\TipoAfectacion;
use App\Enums\Notificacion\TipoNotificacion;
use App\Traits\IsEstablecimientoOwnedThroughEmpleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Notificacion extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    use IsEstablecimientoOwnedThroughEmpleado;

    protected $fillable = [
        'codigo',
        'fecha',
        'hora',
        'lugar',
        'descripcion_situacion',
        'descripcion_lesion',
        'tipo_notificacion',
        'tipo_afectacion',
        'empleado_id',
        // 'responsable_id',
        'reportante_id',
    ];

    protected $casts = [
        'tipo_notificacion' => TipoNotificacion::class,
        'tipo_afectacion' => TipoAfectacion::class,
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function testigos()
    {
        return $this->hasMany(Testigo::class);
    }

}
