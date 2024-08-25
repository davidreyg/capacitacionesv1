<?php

namespace App\Models\Laboratorio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPrueba extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre'];
}
