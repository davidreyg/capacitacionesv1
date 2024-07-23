<?php

namespace App\Actions;

use App\DTO\AsistenciaData;
use App\Enums\Setting\ReportType;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerarPdf
{
    use AsAction;

    public function handle(ReportType $tipoReporte, AsistenciaData $data)
    {

        $html = view('components.layouts.pdf', ['current' => $tipoReporte->value, 'datos' => $data])->render();
        $pdf = SnappyPdf::loadView('components.layouts.pdf', ['current' => $tipoReporte->value, 'datos' => $data])
            ->setPaper('A4', 'landscape')
            ->setOption('encoding', 'UTF-8')
            ->setOption('enable-javascript', true)
            ->setOption('header-html', $this->header())
            ->setOption('footer-html', $this->footer());

        return $pdf->inline('reporteasistencia');
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
