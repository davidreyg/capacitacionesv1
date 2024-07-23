<?php

namespace App\Actions;

use App\DTO\AsistenciaData;
use App\Enums\Setting\ReportType;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Gotenberg\Exceptions\GotenbergApiErrored;
use Gotenberg\Gotenberg;
use Gotenberg\Stream;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerarPdf
{
    use AsAction;

    // TODO: ELIMINAR SNAPPY
    public function handle(ReportType $tipoReporte, AsistenciaData $data)
    {
        // dd(vite('resources/css/pdf/pdf.css', hotServer: false, relative: false));
        $html = view('components.layouts.pdf', ['current' => $tipoReporte->value, 'datos' => $data])->render();
        $pdf = SnappyPdf::loadView('components.layouts.pdf', ['current' => $tipoReporte->value, 'datos' => $data])
            ->setPaper('A4', 'landscape')
            ->setOption('encoding', 'UTF-8')
            ->setOption('enable-javascript', true)
            ->setOption('header-html', $this->header())
            ->setOption('footer-html', $this->footer());


        $request = Gotenberg::chromium('http://gotenberg:3000')
            ->pdf()
            ->header(Stream::string('header.html', $this->header()))
            ->footer(Stream::string('footer.html', $this->footer()))
            ->landscape()
            ->margins('90px', '50px', '30px', '30px')
            ->printBackground()
            ->preferCssPageSize()
            ->assets(Stream::path(public_path(vite('resources/css/pdf/pdf.css', hotServer: false, relative: true)), 'pdf.css'))
            ->html(Stream::string('pdf.html', $html));

        try {
            $response = Gotenberg::send($request);
            return response(
                $response->getBody(),
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="xd"',
                ]
            );

        } catch (GotenbergApiErrored $e) {
            $e->getResponse();
            echo $e->getTraceAsString();
            throw new \Exception($e->getMessage());
        }
        // return $pdf->inline('reporteasistencia');
    }

    private function header()
    {
        $logoPath = public_path('images/diris.png'); // Ruta a la imagen en el sistema de archivos
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoBase64 = "data:image/jpg;base64,$logoData";

        $establecimiento = auth()->user()->load('establecimiento')->establecimiento->nombre;
        return view('components.pdf.header', ['logoBase64' => $logoBase64, 'establecimiento' => $establecimiento])->render();
    }

    private function footer()
    {
        $logoPath = public_path('images/diris.png'); // Ruta a la imagen en el sistema de archivos
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoBase64 = "data:image/jpg;base64,$logoData";

        $establecimiento = auth()->user()->load('establecimiento')->establecimiento->nombre;
        return view('components.pdf.footer', ['logoBase64' => $logoBase64, 'establecimiento' => $establecimiento])->render();
    }
}
