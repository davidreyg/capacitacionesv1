<?php
namespace App\Services\AsistenciaDataSource;

use App\Enums\Services\AsistenciaDataSourceType;
use App\Services\Interfaces\AsistenciaSourceInterface;
use Illuminate\Support\Facades\App;

class AsistenciaDataSourceFactory
{
    protected static $sources = [
        AsistenciaDataSourceType::FAKE->value => FakeAsistenciaDataSource::class,
        AsistenciaDataSourceType::DATABASE->value => DatabaseAsistenciaDataSource::class,
    ];

    public static function make(AsistenciaDataSourceType $source): AsistenciaSourceInterface
    {
        return App::make(self::$sources[$source->value]);
    }
}
