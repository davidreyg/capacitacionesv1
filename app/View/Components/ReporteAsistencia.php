<?php

namespace App\View\Components;

use App\DTO\AsistenciaData;
use App\Settings\GeneralSettings;
use App\Settings\ReportSettings;
use Closure;
use Filament\Panel\Concerns\HasFont;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReporteAsistencia extends Component
{
    use HasFont;
    public ReportSettings $reportSettings;
    public GeneralSettings $generalSettings;
    public AsistenciaData $datos;
    public string $fontFam;
    public Htmlable $fontHtml;

    public function __construct(AsistenciaData $datos, ReportSettings $reportSettings, GeneralSettings $generalSettings)
    {
        $this->reportSettings = $reportSettings;
        $this->fontFam = $this->reportSettings->font->getLabel();
        $this->fontHtml = $this->font($this->reportSettings->font->getLabel())->getFontHtml();

        $this->generalSettings = $generalSettings;
        $this->datos = $datos;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reporte-asistencia');
    }
}
