<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre'];

    public function items()
    {
        return $this->belongsToMany(Item::class)
            ->withPivot(['valor']);
    }
}
