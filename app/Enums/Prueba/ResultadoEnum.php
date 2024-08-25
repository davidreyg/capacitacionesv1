<?php

namespace App\Enums\Prueba;

enum ResultadoEnum: string
{
    case NO_REACTIVO = 'No Reactivo';
    case REACTIVO = 'Reactivo';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->value;
        }
        return $array;
    }
}
