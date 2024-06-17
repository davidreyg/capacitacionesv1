<?php

namespace App\Models;

use App\States\Asignacion\AsignacionState;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Asignacion extends Model
{
    use HasStates;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = ['establecimiento_id', 'evento_id', 'capacitacion_id', 'estado'];
    protected $casts = [
        'estado' => AsignacionState::class,
    ];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
