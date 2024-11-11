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
    private string $logo;
    private float $width;
    private float $height;
    private ?string $header;
    private string $filename;

    public function handle(ReportType $tipoReporte, object $data)
    {
        $FILENAME = $this->getFilename() . '_' . now()->format('d_m_Y') . '.pdf';
        $html = view('components.layouts.pdf', ['current' => $tipoReporte->value, 'datos' => $data, 'filename' => $FILENAME])->render();
        $request = Gotenberg::chromium('http://gotenberg:3000')
            ->pdf()
            ->header(Stream::string('header.html', $this->getHeader()))
            ->footer(Stream::string('footer.html', $this->footer()))
            ->paperSize(8.27, 11.7)
            // ->landscape()
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

    public function header(string $view)
    {
        //FIXME: Quitamos esto por la reestructuracion
        // $establecimiento = auth()->user()->load('establecimiento')->establecimiento->nombre;
        $this->header = view(isset($view) ? $view : 'components.pdf.header', ['logoBase64' => $this->logo()])->render();
        return $this;
    }

    public function filename(string $filename)
    {
        $this->filename = $filename;
        return $this;
    }

    public function getHeader()
    {
        // Verifica si el header ya está inicializado, si no, lo inicializa.
        if (empty($this->header)) {
            $this->header('components.pdf.header');
        }
        return $this->header;
    }

    public function getFilename()
    {
        // Verifica si el header ya está inicializado, si no, lo inicializa.
        if (empty($this->filename)) {
            $this->filename = 'DocumentoPdf';
        }
        return $this->filename;
    }


    private function logo(): string
    {
        $logoPath = public_path('images/diris.png'); // Ruta a la imagen en el sistema de archivos
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoBase64 = "data:image/jpg;base64,$logoData";
        return $logoBase64;
    }

    private function footer()
    {
        return view('components.pdf.footer')->render();
    }
}
