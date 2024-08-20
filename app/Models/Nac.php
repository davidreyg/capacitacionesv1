<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nac extends Model
{
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre', 'parent_id'];
    use HasFactory;
}
