<?php

namespace App\Models\AnexoUno;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riesgo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre'];
}
