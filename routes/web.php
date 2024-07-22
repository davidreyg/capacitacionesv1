<?php

use App\Actions\GenerarPdf;
use App\Enums\Setting\ReportType;
use App\Services\AsistenciaDataSource\AsistenciaDataSourceFactory;
use App\Enums\Services\AsistenciaDataSourceType;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/preview-pdf', function () {
    $dataSource = AsistenciaDataSourceFactory::make(AsistenciaDataSourceType::FAKE);
    return GenerarPdf::make()->handle(ReportType::ASISTENCIA, $dataSource->getData(1));
});

Route::get('/asistencia', function () {
    $dataSource = AsistenciaDataSourceFactory::make(AsistenciaDataSourceType::FAKE);
    return view('components.layouts.pdf', ['current' => ReportType::ASISTENCIA->value, 'datos' => $dataSource->getData(1)])->render();
});
