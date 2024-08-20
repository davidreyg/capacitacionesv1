<?php

namespace App\Filament\Admin\Resources\NotificacionResource\Pages;

use App\Filament\Admin\Resources\NotificacionResource;
use App\Forms\Components\NestedCheckboxList;
use App\Models\CausaBasica;
use App\Models\CausaInmediata;
use App\Models\TipoContacto;
use App\Models\TipoContactoCausaInmediata;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\EditRecord;

// TODO: Falta realizar esta funcionalidad.
class EvaluarNotificacion extends EditRecord
{
    protected static string $resource = NotificacionResource::class;

    protected static string $view = 'filament.admin.resources.notificacion-resource.pages.evaluar-notifiacion';

    public function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                Wizard\Step::make('Tipo de Contacto')
                    ->description('Por favor seleccione...')
                    ->schema([
                        CheckboxList::make('tipo_contacto_ids')
                            ->hiddenLabel()
                            ->options(fn() => TipoContacto::pluck('nombre', 'id')),
                    ]),
                Wizard\Step::make('Causas Inmediatas (CI)')
                    ->description('')
                    ->schema([
                        Placeholder::make('cd')->content(fn(Get $get) => implode(',', $get('tipo_contacto_ids'))),
                        CheckboxList::make('causa_inmediata_ids')
                            ->options(function (Get $get) {
                                $causasInmediatas = TipoContacto::whereIn('id', $get('tipo_contacto_ids'))
                                    ->with('causaInmediatas')
                                    ->get()
                                    ->pluck('causaInmediatas')
                                    ->flatten()
                                    ->sortBy('id')
                                    ->pluck('nombre', 'id');

                                // dd($causasInmediatas);
                                return $causasInmediatas;
                            }),
                    ]),
                Wizard\Step::make('Causas Básicas (CB)')
                    ->description('')
                    ->schema([
                        Placeholder::make('cdf')->content(fn(Get $get) => implode(',', $get('causa_inmediata_ids'))),
                        NestedCheckboxList::make('causa_basica_ids')
                            ->options(function (Get $get) {
                                $causasBasicasIds = CausaInmediata::whereIn('id', $get('causa_inmediata_ids'))
                                    ->with('causaBasicas')
                                    ->get()
                                    ->pluck('causaBasicas')
                                    ->flatten()
                                    ->pluck('id');
                                $causaBasicaWithChildren = CausaBasica::whereIn('id', $causasBasicasIds)
                                    ->with('descendants')
                                    ->get()
                                    ->flatMap(function ($causa) {
                                        return $causa->descendantsAndSelf()->get();
                                    });
                                // dd($causaBasicaWithChildren);
                                return $causaBasicaWithChildren;
                            })
                            ->minItems(1)
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),
                Wizard\Step::make('Necesidades de Acción de Control (NAC)')
                    ->description('')
                    ->schema([
                        Placeholder::make('cdf')->content(fn(Get $get) => implode(',', $get('causa_basica_ids'))),
                    ]),
            ])->columnSpanFull(),

        ]);
    }
}
