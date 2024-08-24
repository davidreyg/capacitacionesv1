<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CausaInmediata extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre'];

    public function tipoContactos()
    {
        return $this->belongsToMany(TipoContacto::class, 'tipo_contacto_causa_inmediata');
    }

    public function causaBasicas()
    {
        return $this->belongsToMany(CausaBasica::class, 'causa_inmediata_causa_basica');
    }
}
