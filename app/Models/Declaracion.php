<?php

namespace App\Models;

use App\Enums\Declaracion\TipoDeclaranteEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declaracion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_declarante',
        'fecha_ocurrencia',
        'hora_ocurrencia',
        'lugar_ocurrencia',
        'reportado_jefe_inmediato',
        'empleado_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'reportado_jefe_inmediate' => 'boolean',
        'tipo_declarante' => TipoDeclaranteEnum::class,
    ];

    public function preguntas()
    {
        return $this->belongsToMany(Pregunta::class)->withPivot(['respuesta']);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function declaracionPreguntas()
    {
        return $this->hasMany(DeclaracionPregunta::class);
    }

    public function notificacion()
    {
        return $this->belongsTo(Notificacion::class);
    }
}
