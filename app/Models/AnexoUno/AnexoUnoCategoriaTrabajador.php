<?php

namespace App\Models\AnexoUno;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnexoUnoCategoriaTrabajador extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['codigo','descripcion'];
}
