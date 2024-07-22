<?php

namespace App\View\Components;

use App\DTO\AsistenciaData;
use App\Settings\ReportSettings;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReporteAsistencia extends Component
{
    public ReportSettings $reportSettings;
    public AsistenciaData $asistenciaData;

    public function __construct(AsistenciaData $asistenciaData, ReportSettings $reportSettings)
    {
        $this->reportSettings = $reportSettings;
        $this->asistenciaData = $asistenciaData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reporte-asistencia');
    }
}
