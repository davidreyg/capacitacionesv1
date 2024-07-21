<?php

use App\Actions\GenerarPdf;
use App\Enums\Setting\ReportType;
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
    return GenerarPdf::make()->handle(ReportType::ASISTENCIA, ['nombre' => 'david', 'perro' => 'loco gallo']);
});
