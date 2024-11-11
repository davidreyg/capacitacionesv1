<?php

namespace App\Models\RegistroAccidente;

use App\Enums\RegistroAccidente\CausasGrupoEnum;
use App\Enums\RegistroAccidente\CausasTipoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroAccidenteCausa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'tipo' => CausasTipoEnum::class,
        'grupo' => CausasGrupoEnum::class,
    ];

}
