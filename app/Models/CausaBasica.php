<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CausaBasica extends Model
{
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre', 'parent_id'];

    public function nacs()
    {
        return $this->belongsToMany(Nac::class, 'causa_basica_nac');
    }
}
