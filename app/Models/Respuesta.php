<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre', 'valor', 'item_id'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
