<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre', 'grupo_item_id'];

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }

    public function grupoItem()
    {
        return $this->belongsTo(GrupoItem::class);
    }
}
