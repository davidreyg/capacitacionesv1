<?php

namespace App\Models;

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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'reportado_jefe_inmediate' => 'boolean',
    ];

    /**
     * The preguntas that belong to the Declaracion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function preguntas()
    {
        return $this->belongsToMany(Pregunta::class)->withPivot(['respuesta']);
    }
}
