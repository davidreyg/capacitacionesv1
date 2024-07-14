<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    public $timestamps = false;
    protected $fillable = ['nombre', 'descripcion', 'valor', 'evento_id'];
    use HasFactory;

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
