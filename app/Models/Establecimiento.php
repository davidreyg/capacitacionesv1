<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'codigo',
        'direccion',
        'categoria',
        'telefono',
        'ris',
        'tipo',
        'distrito',
        'correo',
        'parent_id',
    ];
    protected $casts = [
        'has_lab' => 'boolean'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
