<?php

namespace App\Models\RegistroAccidente;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroAccidenteResponsable extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
