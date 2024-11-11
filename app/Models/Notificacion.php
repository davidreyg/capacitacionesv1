<?php

namespace App\Models;

use App\Enums\Notificacion\TipoAfectacion;
use App\Enums\Notificacion\TipoNotificacion;
use App\Models\AnexoUno\AnexoUno;
use App\Models\RegistroAccidente\RegistroAccidente;
use App\States\Notificacion\NotificacionState;
use App\Traits\IsEstablecimientoOwnedThroughEmpleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;

class Notificacion extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    use IsEstablecimientoOwnedThroughEmpleado;
    use HasStates;

    protected $fillable = [
        'codigo',
        'fecha',
        'hora',
        'lugar',
        'descripcion_situacion',
        'descripcion_lesion',
        'tipo_notificacion',
        'estado',
        'tipo_notificacion_verificado',
        'tipo_afectacion',
        'empleado_id',
        // 'responsable_id',
        'reportante_id',
    ];

    protected $casts = [
        'estado' => NotificacionState::class,
        'tipo_notificacion' => TipoNotificacion::class,
        'tipo_notificacion_verificado' => TipoNotificacion::class,
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

    public function tipoContactos()
    {
        return $this->belongsToMany(TipoContacto::class, 'notificacion_tipo_contacto');
    }

    public function causaInmediatas()
    {
        return $this->belongsToMany(CausaInmediata::class, 'notificacion_causa_inmediata');
    }

    public function causaBasicas()
    {
        return $this->belongsToMany(CausaBasica::class, 'notificacion_causa_basica');
    }

    public function nacs()
    {
        return $this->belongsToMany(Nac::class, 'notificacion_nac')
            ->withPivot(['P', 'E', 'C'])
            ->using(NotificacionNac::class);
    }

    public function anexoUno()
    {
        return $this->hasOne(AnexoUno::class);
    }

    public function registroAccidente()
    {
        return $this->hasOne(RegistroAccidente::class);
    }

    public function declaracions()
    {
        return $this->hasMany(Declaracion::class);
    }

}
