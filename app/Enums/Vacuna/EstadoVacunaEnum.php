<?php

namespace App\Enums\Vacuna;

enum EstadoVacunaEnum: string
{
    case APLICADO = 'Aplicado';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->name] = $case->value;
        }
        return $array;
    }
}
