<?php

namespace App\View\Components;

use App\DTO\AsistenciaData;
use App\Settings\GeneralSettings;
use App\Settings\ReportSettings;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReporteAsistencia extends Component
{
    public ReportSettings $reportSettings;
    public GeneralSettings $generalSettings;
    public AsistenciaData $datos;

    public function __construct(AsistenciaData $datos, ReportSettings $reportSettings, GeneralSettings $generalSettings)
    {
        $this->reportSettings = $reportSettings;
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
