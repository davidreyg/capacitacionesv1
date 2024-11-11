<?php

namespace App\View\Components;

use App\Models\Evento;
use App\Models\RegistroAccidente\RegistroAccidente;
use App\Settings\GeneralSettings;
use App\Settings\ReportSettings;
use Closure;
use Filament\Panel\Concerns\HasFont;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FichaRegistroAccidente extends Component
{
    use HasFont;
    public ReportSettings $reportSettings;
    public GeneralSettings $generalSettings;
    public RegistroAccidente $registroAccidente;
    public string $fontFam;
    public Htmlable $fontHtml;

    public function __construct(RegistroAccidente $datos, ReportSettings $reportSettings, GeneralSettings $generalSettings)
    {
        $this->reportSettings = $reportSettings;
        $this->fontFam = $this->reportSettings->font->getLabel();
        $this->fontHtml = $this->font($this->reportSettings->font->getLabel())->getFontHtml();
        // dd($this->fontHtml);
        $this->generalSettings = $generalSettings;
        // EMPEZAMOS L REPORTE
        $this->registroAccidente = $datos->load([
            // 'modalidad',
            // 'oportunidad',
            // 'costosIndirectos',
            // 'costosDirectos',
            // 'capacitacion.nivels',
            // 'capacitacion.respuestas.item.grupoItem',
            // 'empleados.unidadOrganica',
            // 'empleados.cargo'
        ]);
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ficha-registro-accidente');
    }
}
