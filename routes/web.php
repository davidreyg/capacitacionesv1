<?php

use App\Actions\GenerarPdf;
use App\DTO\IndicadorFiltroData;
use App\Enums\Setting\ReportType;
use App\Models\AnexoUno\AnexoUno;
use App\Models\Declaracion;
use App\Models\Evento;
use App\Models\RegistroAccidente\RegistroAccidente;
use App\Services\AsistenciaDataSource\AsistenciaDataSourceFactory;
use App\Enums\Services\AsistenciaDataSourceType;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
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
Route::get('/preview-pdf', function (Request $request) {
    if (!Filament::auth()->check()) {
        abort(401, 'No estas autenticado con filament.');
    }
    $sourceType = $request->query('tipo_reporte');
    $sesionId = $request->query('sesion_id');
    // Verifica si ambos parámetros están presentes
    if (!$sourceType || !$sesionId) {
        abort(400, 'El tipo de reporte y la ID de la sesion son obligatorios');
    }

    // Convierte el tipo de fuente de datos al enum correspondiente
    $sourceTypeEnum = AsistenciaDataSourceType::tryFrom($sourceType);

    // // Verifica si el tipo de fuente de datos es válido
    if (!$sourceTypeEnum) {
        abort(400, 'Invalid source type');
    }

    // Crea la fuente de datos y obtiene los datos necesarios
    $dataSource = AsistenciaDataSourceFactory::make($sourceTypeEnum);
    $data = $dataSource->getData($sesionId);

    // Genera el PDF y retorna la respuesta de descarga
    return GenerarPdf::make()->handle(ReportType::ASISTENCIA, $data);
})
    // ->middleware(['auth.filament'])
    ->name('preview-pdf');

Route::get('/ficha-capacitacion-pdf', function (Request $request) {
    if (!Filament::auth()->check()) {
        abort(401, 'No estas autenticado con filament.');
    }
    // $sourceType = $request->query('tipo_reporte');
    $eventoId = $request->query('evento_id');
    // Verifica si ambos parámetros están presentes
    if (!$eventoId) {
        abort(400, 'El ID del evento son obligatorios');
    }

    $evento = Evento::findOrFail($eventoId);
    // return view('components.layouts.pdf', ['current' => ReportType::FICHA_CAPACITACION->value, 'datos' => $evento])->render();
    // Genera el PDF y retorna la respuesta de descarga
    return GenerarPdf::make()->filename('reporte_asistencia')->handle(ReportType::FICHA_CAPACITACION, $evento);
})
    ->name('ficha-capacitacion');

Route::get('/asistencia', function () {
    $dataSource = AsistenciaDataSourceFactory::make(AsistenciaDataSourceType::FAKE);
    return view('components.layouts.pdf', ['current' => ReportType::ASISTENCIA->value, 'datos' => $dataSource->getData(1)])->render();
});

Route::get('/pdf/registro-accidente/{id}', function (int $id) {
    $registroAccidente = RegistroAccidente::findOrFail($id);
    return GenerarPdf::make()
        ->filename('registro_accidente')
        ->header('components.pdf.header-registro-accidente')
        ->handle(ReportType::FICHA_REGISTRO_ACCIDENTE, $registroAccidente);
})->middleware(['auth'])->name('registro-accidente-pdf');

Route::get('/pdf/declaracion-testigo/{id}', function (int $id) {
    $declaracion = Declaracion::findOrFail($id);
    return GenerarPdf::make()
        ->filename('registro_accidente')
        ->header('components.pdf.header-declaracion-testigo')
        ->marginTop('100px')
        ->handle(ReportType::DECLARACION_TESTIGO_PDF, $declaracion);
})->middleware(['auth'])->name('declaracion-pdf');

Route::get('/pdf/anexo-uno/{id}', function (int $id) {
    $anexoUno = AnexoUno::findOrFail($id);
    return GenerarPdf::make()
        ->filename('anexo_uno')
        ->header('components.pdf.header-anexo-uno')
        ->marginTop('90px')
        ->marginLeft('100px')
        ->marginRight('100px')
        ->handle(ReportType::ANEXO_UNO, $anexoUno);
})->middleware(['auth'])->name('anexo-uno-pdf');

Route::get('/pdf/indicadores', function (Request $request) {
    $startDate = Carbon::createFromFormat('Y-m', $request->fecha_inicio)->startOfMonth();
    $endDate = Carbon::createFromFormat('Y-m', $request->fecha_fin)->endOfMonth();
    return GenerarPdf::make()
        ->landscape()
        ->filename('indicadores')
        ->header('components.pdf.header')
        ->marginTop('90px')
        ->marginLeft('20px')
        ->marginRight('20px')
        ->handle(ReportType::INDICADORES, new IndicadorFiltroData($startDate, $endDate));
})->middleware(['auth'])->name('indicadores-pdf');
