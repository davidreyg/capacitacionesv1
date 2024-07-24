<?php

namespace App\Actions;

use App\DTO\AsistenciaData;
use App\Enums\Setting\ReportType;
use Gotenberg\Exceptions\GotenbergApiErrored;
use Gotenberg\Gotenberg;
use Gotenberg\Stream;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerarPdf
{
    use AsAction;

    public function handle(ReportType $tipoReporte, AsistenciaData $data)
    {
        $html = view('components.layouts.pdf', ['current' => $tipoReporte->value, 'datos' => $data])->render();
        $FILENAME = 'formato_asistencia_' . now()->format('d_m_Y') . '.pdf';
        $request = Gotenberg::chromium('http://gotenberg:3000')
            ->pdf()
            ->header(Stream::string('header.html', $this->header()))
            ->footer(Stream::string('footer.html', $this->footer()))
            ->paperSize(8.27, 11.7)
            ->landscape()
            ->margins('90px', '50px', '30px', '30px')
            ->printBackground()
            ->preferCssPageSize()
            ->assets(Stream::path(public_path(vite('resources/css/pdf/pdf.css', hotServer: false, relative: true)), 'pdf.css'))
            ->html(Stream::string('pdf.html', $html));

        try {
            $response = Gotenberg::send($request);
            return response(
                $response->getBody()->getContents(),
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => "inline; filename=$FILENAME",
                ]
            );

        } catch (GotenbergApiErrored $e) {
            $e->getResponse();
            echo $e->getTraceAsString();
            throw new \Exception($e->getMessage());
        }
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
        return view('components.pdf.footer')->render();
    }
}
