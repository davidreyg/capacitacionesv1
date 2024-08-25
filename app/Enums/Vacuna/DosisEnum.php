<?php

namespace App\Enums\Vacuna;

enum DosisEnum: string
{
    case PRIMERA = '1ra. Dosis';
    case SEGUNDA = '2da. Dosis';
    case TERCERA = '3ra. Dosis';
    case CUARTA = '4ta. Dosis';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->value;
        }
        return $array;
    }
}
