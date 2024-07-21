<?php

namespace App\Livewire;

use App\Settings\ReportSettings;
use Livewire\Component;

class ReporteAsistencia extends Component
{

    public string $logo;
    public array $data;

    function mount(array $data, ReportSettings $reportSettings)
    {
        $this->logo = \Storage::url($reportSettings->logo);
        $this->data = $data;
    }
    public function render()
    {
        return view('livewire.reporte-asistencia');
    }
}
