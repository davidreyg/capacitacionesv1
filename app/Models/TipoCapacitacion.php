<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCapacitacion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre'];
}
