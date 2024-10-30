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
use App\Utilities\TreeBuilder;
use Blade;
use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\EditRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;



class ScatNotificacion extends EditRecord
{
    use NestedPage;

    protected static string $resource = NotificacionResource::class;

    protected static string $view = 'filament.admin.resources.notificacion-resource.pages.scat-notificacion';
    protected ?bool $hasDatabaseTransactions = true;

    protected function authorizeAccess(): void
    {
        abort_unless(static::getResource()::can('evaluarScat', $this->record), 403);
    }
    function getHeaderActions(): array
    {
        return [
            Action::make('resumen')
                ->color('info')
                ->icon('tabler-clipboard-list')
                ->fillForm(function (ScatNotificacion $livewire) {
                    $nacData = collect(data_get($livewire, $livewire->getFormStatePath() . '.nac_ids'))
                        ->filter(function ($values) {
                            return collect($values)->contains(true);
                        });
                    return [
                        'tipo_contacto_resumen' => data_get($livewire, $livewire->getFormStatePath() . '.tipo_contacto_ids'),
                        'causa_inmediata_resumen' => data_get($livewire, $livewire->getFormStatePath() . '.causa_inmediata_ids'),
                        'causa_basica_resumen' => data_get($livewire, $livewire->getFormStatePath() . '.causa_basica_ids'),
                        'nac_resumen' => $nacData,
                    ];
                })
                ->form([
                    Section::make('1. Tipo de Contacto')
                        ->visible(fn(ScatNotificacion $livewire) => !empty (data_get($livewire, $livewire->getFormStatePath() . '.tipo_contacto_ids')))
                        ->collapsible()
                        ->aside()
                        ->schema([
                            CheckboxList::make('tipo_contacto_resumen')
                                ->hiddenLabel()
                                ->disabled()
                                ->options(fn($state) => TipoContacto::whereIn('id', $state)->pluck('nombre', 'id')),
                        ]),
                    Section::make('2. Causas Inmediatas')
                        ->visible(fn(ScatNotificacion $livewire) => !empty (data_get($livewire, $livewire->getFormStatePath() . '.causa_inmediata_ids')))
                        ->collapsible()
                        ->aside()
                        ->schema([
                            CheckboxList::make('causa_inmediata_resumen')
                                ->hiddenLabel()
                                ->disabled()
                                ->options(fn($state) =>
                                    CausaInmediata::whereIn('id', $state)->pluck('nombre', 'id')),
                        ]),
                    Section::make('3. Causas Basicas')
                        ->visible(fn(ScatNotificacion $livewire) => !empty (data_get($livewire, $livewire->getFormStatePath() . '.causa_basica_ids')))
                        ->collapsible()
                        ->aside()
                        ->schema([
                            NestedCheckboxList::make('causa_basica_resumen')
                                ->hiddenLabel()
                                ->disabled()
                                ->options(
                                    fn($state) => CausaBasica::whereIn('id', $state)
                                        ->with('bloodline')
                                        ->get()
                                        ->pluck('bloodline')
                                        ->flatten()
                                        ->unique('id')
                                )
                                ->columnSpanFull(),
                        ]),
                    Section::make('4. Necesidades de Acción de Control (NAC)')
                        ->visible(fn(ScatNotificacion $livewire) => !empty (data_get($livewire, $livewire->getFormStatePath() . '.nac_ids')))
                        ->collapsible()
                        ->aside()
                        ->schema([
                            NestedMatrix::make('nac_resumen')
                                ->disabled()
                                ->hiddenLabel()
                                ->asCheckbox()
                                ->columnData([
                                    'P' => 'P',
                                    'E' => 'E',
                                    'C' => 'C',
                                ])
                                ->options(
                                    function ($state) {
                                        return Nac::whereIn('id', array_keys($state))
                                            ->with('bloodline')
                                            ->get()
                                            ->pluck('bloodline')
                                            ->flatten()
                                            ->unique('id');
                                    }
                                )
                                ->columnSpanFull()
                                ->rowSelectRequired(false),
                        ]),
                ])
        ];
    }

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
                                    ->with('descendantsAndSelf')
                                    ->get()
                                    ->pluck('descendantsAndSelf')
                                    ->flatten()
                                    ->unique('id');
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
                                    ->pluck('descendantsAndSelf')
                                    ->flatten()
                                    ->unique('id');
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

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return parent::shouldRegisterNavigation($parameters) && static::getResource()::can('evaluarScat', $parameters['record']);
    }

    public function getFormActions(): array
    {
        return [
            // ...parent::getFormActions(),
            // Action::make('close')->action('saveAndClose'),
        ];
    }
}
