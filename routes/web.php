<?php

use App\Actions\GenerarPdf;
use App\Enums\Setting\ReportType;
use App\Services\EmpleadoSesionDataSource\EmpleadoSesionDataSourceFactory;
use App\Enums\Services\EmpleadoSesionDataSourceType;
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
// Route::get('/asistencia', ReporteAsistencia::class)->name('asistencia')->middleware(['force.https']);
Route::get('/preview-pdf', function () {
    $dataSource = EmpleadoSesionDataSourceFactory::make(EmpleadoSesionDataSourceType::FAKE);
    // dd($dataSource->getData());

    return GenerarPdf::make()->handle(ReportType::ASISTENCIA, $dataSource->getData());
});
