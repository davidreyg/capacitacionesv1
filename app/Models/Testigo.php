<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testigo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre_completo'];

    public function notificacion()
    {
        return $this->belongsTo(Notificacion::class);
    }
}
