<?php

namespace App\Livewire;

use App\Settings\GeneralSettings;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.pdf')]
class ReporteAsistencia extends Component
{

    public string $logo;

    function mount(GeneralSettings $generalSettings)
    {
        $this->logo = \Storage::url($generalSettings->brand_logo);
    }
    public function render()
    {
        return view('livewire.reporte-asistencia');
    }
}
