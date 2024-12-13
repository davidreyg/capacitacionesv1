<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Forms\IndicadoresForm;
use App\Models\Periodo;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Collection;

class Indicadores extends Page
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'tabler-traffic-lights';

    protected static string $view = 'filament.admin.pages.indicadores';

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
        ]);
        $this->dispatch('submitForm', $url);
    }
}
