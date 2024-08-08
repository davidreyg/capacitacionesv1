<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CausaBasica extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre', 'parent_id'];
}
