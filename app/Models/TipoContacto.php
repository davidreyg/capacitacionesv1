<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContacto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre'];

    public function causaInmediatas()
    {
        return $this
            ->belongsToMany(CausaInmediata::class, 'tipo_contacto_causa_inmediata')
            ->using(TipoContactoCausaInmediata::class);
    }
}
