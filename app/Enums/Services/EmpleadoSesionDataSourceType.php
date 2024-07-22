<?php
// app/Enums/EmpleadoSesionDataSourceType.php
namespace App\Enums\Services;

enum EmpleadoSesionDataSourceType: string
{
    case FAKE = 'fake';
    case DATABASE = 'database';
    // case JSON = 'json';
}
