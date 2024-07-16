<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;

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

Route::get('/test', function () {
    $html = view('welcome')->render();

    $pdf_content = Browsershot::html($html)
        ->timeout(60)
        ->waitUntilNetworkIdle()
        ->windowSize(502, 850)
        ->noSandbox();
    if (config('app-pdf.node')) {
        $pdf_content = $pdf_content->setNodeBinary(config('app-pdf.node'));
    }

    if (config('app-pdf.npm')) {
        $pdf_content = $pdf_content->setNpmBinary(config('app-pdf.npm'));
    }

    if (config('app-pdf.modules')) {
        $pdf_content = $pdf_content->setIncludePath(config('app-pdf.modules'));
    }

    if (config('app-pdf.chrome')) {
        $pdf_content = $pdf_content->setChromePath(config('app-pdf.chrome'));
    }

    if (config('app-pdf.chrome_arguments')) {
        $pdf_content = $pdf_content->addChromiumArguments(config('app-pdf.chrome_arguments'));
    }

    return new Response($pdf_content->pdf(), 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="example.pdf"'
    ]);
});
