<?php

namespace App\Filament\Admin\Resources\NotificacionResource\Pages;

use App\Filament\Admin\Resources\NotificacionResource;
use App\Forms\Components\NestedCheckboxList;
use App\Forms\Components\NestedMatrix;
use App\Models\CausaBasica;
use App\Models\CausaInmediata;
use App\Models\Nac;
use App\Models\Notificacion;
use App\Models\TipoContacto;
use Blade;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;


class EvaluarNotificacion extends EditRecord
{
    protected static string $resource = NotificacionResource::class;

    protected static string $view = 'filament.admin.resources.notificacion-resource.pages.evaluar-notificacion';
    protected ?bool $hasDatabaseTransactions = true;


    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['tipo_contacto_ids'] = $this->getRecord()->tipoContactos()->pluck('tipo_contactos.id');
        $data['causa_inmediata_ids'] = $this->getRecord()->causaInmediatas()->pluck('causa_inmediatas.id');
        $data['causa_basica_ids'] = $this->getRecord()->causaBasicas()->pluck('causa_basicas.id');
        $data['nac_ids'] = $this->getRecord()->nacs()->get()->mapWithKeys(function (Nac $nac) {
            return [
                $nac->id => [
                    'P' => $nac->pivot->P ?? false,
                    'E' => $nac->pivot->E ?? false,
                    'C' => $nac->pivot->C ?? false,
                ],
            ];
        });
        return $data;
    }

    protected function handleRecordUpdate(Notificacion|Model $record, array $data): Model
    {
        $record->tipoContactos()->sync($data['tipo_contacto_ids']);
        $record->causaInmediatas()->sync($data['causa_inmediata_ids']);
        $record->causaBasicas()->sync($data['causa_basica_ids']);
        $nacData = collect($data['nac_ids'])->filter(function ($values) {
            return collect($values)->contains(true);
        })->mapWithKeys(function ($values, $nacId) {
            return [
                $nacId => [
                    'P' => $values['P'] ?? false,
                    'E' => $values['E'] ?? false,
                    'C' => $values['C'] ?? false,
                ],
            ];
        });
        $record->nacs()->sync($nacData);

        return $record;
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                Wizard\Step::make('Tipo de Contacto')
                    ->description('Por favor seleccione...')
                    ->schema([
                        CheckboxList::make('tipo_contacto_ids')
                            ->hiddenLabel()
                            ->minItems(1)
                            ->options(fn() => TipoContacto::pluck('nombre', 'id')),
                    ]),
                Wizard\Step::make('Causas Inmediatas (CI)')
                    ->description('')
                    ->schema([
                        CheckboxList::make('causa_inmediata_ids')
                            ->hiddenLabel()
                            ->minItems(1)
                            ->options(function (Get $get) {
                                $causasInmediatas = TipoContacto::whereIn('id', $get('tipo_contacto_ids'))
                                    ->with('causaInmediatas')
                                    ->get()
                                    ->pluck('causaInmediatas')
                                    ->flatten()
                                    ->sortBy('id')
                                    ->pluck('nombre', 'id');

                                return $causasInmediatas;
                            }),
                    ]),
                Wizard\Step::make('Causas Básicas (CB)')
                    ->description('')
                    ->schema([
                        NestedCheckboxList::make('causa_basica_ids')
                            ->hiddenLabel()
                            ->minItems(1)
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
                                return $causaBasicaWithChildren;
                            })
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),
                Wizard\Step::make('Necesidades de Acción de Control (NAC)')
                    ->description('')
                    ->schema([
                        NestedMatrix::make('nac_ids')
                            ->hiddenLabel()
                            ->minItems(1)
                            ->asCheckbox()
                            ->columnData([
                                'P' => 'P',
                                'E' => 'E',
                                'C' => 'C',
                            ])
                            ->options(function (Get $get) {
                                $causaBasicaParents = CausaBasica::whereIn('id', $get('causa_basica_ids'))
                                    ->with('rootAncestor')
                                    ->get()
                                    ->pluck('rootAncestor.id')
                                    ->flatten()
                                    ->unique();
                                $nacIds = CausaBasica::whereIn('id', $causaBasicaParents)
                                    ->with('nacs')
                                    ->get()
                                    ->pluck('nacs')
                                    ->flatten()
                                    ->pluck('id');

                                $nacBasicaWithChildren = Nac::whereIn('id', $nacIds)
                                    ->with('descendantsAndSelf')
                                    ->get()
                                    ->flatMap(function ($nac) {
                                        return $nac->descendantsAndSelf()->get()->sortBy('id');
                                    });
                                return $nacBasicaWithChildren;
                            })
                            ->columns(2)
                            ->columnSpanFull()
                            ->rowSelectRequired(false),
                    ]),

            ])
                ->columnSpanFull()
                ->submitAction(new HtmlString(Blade::render(<<<BLADE
                    <x-filament::button
                        type="submit"
                        wire:loading.attr="disabled"
                    >
                    <x-filament::loading-indicator class="h-5 w-5"  wire:loading/>
                        Guardar
                    </x-filament::button>
                BLADE))),

        ]);
    }

    public function getFormActions(): array
    {
        return [
            // ...parent::getFormActions(),
            // Action::make('close')->action('saveAndClose'),
        ];
    }
}
