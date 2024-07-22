<?php
// app/Services/EmpleadoSesionDataSource/EmpleadoSesionDataSourceFactory.php
namespace App\Services\EmpleadoSesionDataSource;

use App\Enums\Services\EmpleadoSesionDataSourceType;
use App\Services\Interfaces\EmpleadoSesionDataSourceInterface;
use Illuminate\Support\Facades\App;

class EmpleadoSesionDataSourceFactory
{
    protected static $sources = [
        EmpleadoSesionDataSourceType::FAKE->value => FakeEmpleadoSesionDataSource::class,
        EmpleadoSesionDataSourceType::DATABASE->value => DatabaseEmpleadoSesionDataSource::class,
        // EmpleadoSesionDataSourceType::JSON->value => JsonEmpleadoSesionDataSource::class,
    ];

    public static function make(EmpleadoSesionDataSourceType $source): EmpleadoSesionDataSourceInterface
    {
        return App::make(self::$sources[$source->value]);
    }
}
