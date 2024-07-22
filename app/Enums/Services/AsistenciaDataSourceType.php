<?php
namespace App\Enums\Services;

enum AsistenciaDataSourceType: string
{
    case FAKE = 'fake';
    case DATABASE = 'database';
    // case JSON = 'json';
}
