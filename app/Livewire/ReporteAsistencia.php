<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.pdf')]
class ReporteAsistencia extends Component
{
    public function render()
    {
        return view('livewire.reporte-asistencia');
    }
}
