<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['fecha', 'horas_trabajadas'];

    protected $casts = [
        'fecha' => 'date',
        'horas_trabajadas' => 'int',
    ];

    public static function años(): array
    {
        return [
            '2024' => '2024',
            '2025' => '2025',
        ];
    }

    public static function meses(): array
    {
        return [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];
    }
}
