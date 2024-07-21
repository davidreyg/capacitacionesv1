<?php

namespace App\Actions;

use App\Enums\Setting\ReportType;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Browsershot\Browsershot;

class GenerarPdf
{
    use AsAction;

    public function handle(ReportType $tipoReporte, array $data)
    {
        $html = view('components.layouts.pdf', ['current' => $tipoReporte->value, 'data' => $data])->render();
        $pdf_content = Browsershot::html($html)
            ->timeout(50)
            ->ignoreHttpsErrors()
            ->format('A4')
            ->setOption('newHeadless', true)
            ->waitUntilNetworkIdle()
            ->showBackground()
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

        return response($pdf_content->pdf(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="example.pdf"'
        ]);
    }
}
