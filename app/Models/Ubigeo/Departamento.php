<?php

namespace App\Models\Ubigeo;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Departamento extends Model
{
    use Sushi;

    public $incrementing = false;
    protected $keyType = "string";

    protected $rows = [
        ["id" => "01", "nombre" => "Amazonas"],
        ["id" => "02", "nombre" => "Ancash"],
        ["id" => "03", "nombre" => "Apurimac"],
        ["id" => "04", "nombre" => "Arequipa"],
        ["id" => "05", "nombre" => "Ayacucho"],
        ["id" => "06", "nombre" => "Cajamarca"],
        ["id" => "07", "nombre" => "Cusco"],
        ["id" => "08", "nombre" => "Huancavelica"],
        ["id" => "09", "nombre" => "Huanuco"],
        ["id" => "10", "nombre" => "Ica"],
        ["id" => "11", "nombre" => "Junin"],
        ["id" => "12", "nombre" => "La Libertad"],
        ["id" => "13", "nombre" => "Lambayeque"],
        ["id" => "14", "nombre" => "Lima"],
        ["id" => "15", "nombre" => "Loreto"],
        ["id" => "16", "nombre" => "Madre De Dios"],
        ["id" => "17", "nombre" => "Moquegua"],
        ["id" => "18", "nombre" => "Pasco"],
        ["id" => "19", "nombre" => "Piura"],
        ["id" => "20", "nombre" => "Puno"],
        ["id" => "21", "nombre" => "San Martin"],
        ["id" => "22", "nombre" => "Tacna"],
        ["id" => "23", "nombre" => "Tumbes"],
        ["id" => "24", "nombre" => "Callao"],
        ["id" => "25", "nombre" => "Ucayali"],
    ];

    public function provincias()
    {
        return $this->hasMany(Provincia::class);
    }
}
