<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Forms\IndicadoresForm;
use App\Models\Periodo;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Collection;

class IndicadoresEstablecimiento extends Page
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'tabler-dashboard';
    protected static ?string $title = 'Indicador por Establecimiento';

    protected static string $view = 'filament.admin.pages.indicadores-establecimiento';

    public Collection $periodos;
    public ?array $data = [];
    function mount()
    {
        $this->periodos = Periodo::get();
        $this->data = [
            'añoInicio' => null,
            'mesInicio' => null,
            'añoFin' => null,
            'mesFin' => null,
        ];
    }
    function form(Form $form): Form
    {
        return $form->schema([
            ...IndicadoresForm::form($this->periodos)
        ])->statePath('data');
    }

    function submitForm()
    {
        $data = $this->form->getState();
        $url = route('indicadores-pdf', [
            'fecha_inicio' => "{$data['añoInicio']}-{$data['mesInicio']}",
            'fecha_fin' => "{$data['añoFin']}-{$data['mesFin']}",
            'establecimiento_id' => auth()->user()->empleado->establecimiento_id,
        ]);
        $this->dispatch('submitForm', $url);
    }
}
