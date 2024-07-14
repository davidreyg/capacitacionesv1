<?php

namespace App\Filament\Resources\EventoResource\Pages;

use App\Concerns\CustomPageRecord;
use App\Filament\Resources\EventoResource;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Blade;
use Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class GestionarEventoEvaluaciones extends CustomPageRecord
{
    protected static string $resource = EventoResource::class;
    protected ?string $heading = 'Evaluaciones';
    protected static ?string $breadcrumb = 'Evaluaciones';
    protected ?string $subheading = 'En esta sección podra registrar la forma de evaluar a los asistentes';
    protected static ?string $navigationIcon = 'tabler-notes';

    public static function getNavigationLabel(): string
    {
        return 'Evaluaciones';
    }

    // TODO: Falta realizar este permiso!
    public static function canAccess($parameters = []): bool
    {
        return true;
    }

    protected static string $view = 'filament.resources.evento-resource.pages.gestionar-evento-evaluaciones';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Tipo de evaluacion')
                    ->aside()
                    ->description('Debe elegir si usara el sistema simple o ponderado')
                    ->schema([
                        Toggle::make('evaluacion_simple')
                            ->label('¿Evaluación simple?')
                            ->live()
                            ->hint(new HtmlString(Blade::render('<x-filament::loading-indicator class="h-5 w-5" wire:loading wire:target="data.evaluacion_simple" />')))
                            ->inline(false)
                            ->required(),
                        TextInput::make('porcentaje_total')
                            ->readOnly()
                            // ->visible(fn(Get $get) => !$get('evaluacion_simple'))
                            ->suffix('%')
                            ->rules([
                                fn(): Closure => function (string $attribute, $value, Closure $fail) {
                                    if ((float) $value != 100) {
                                        $fail('El :attribute debe ser igual a 100.');
                                    }
                                },
                            ])
                        // ->afterStateHydrated(function (Get $get, Set $set) {
                        //     self::updateTotals($get, $set);
                        // }),
                    ])->columns(2)
                    ->grow(false),
                Section::make('Lista de evaluaciones')
                    // ->aside()
                    ->heading(fn(Get $get) => $get('evaluacion_simple') ?
                        'Evaluacion Simple' : 'Evaluacion Ponderada')
                    ->description(fn(Get $get) => $get('evaluacion_simple') ?
                        'Las evaluaciones simples solo usaran el promedio simple para calcular las notas del alumno'
                        : 'Tenga en consideración que la sumatoria de los porcentajes debe ser igual al 100%')
                    ->schema([
                        // ...
                        TableRepeater::make('evaluacions')
                            ->relationship()
                            ->addActionLabel('Añadir evaluación')
                            ->hiddenLabel()
                            ->headers(fn(Get $get) => $this->buildRepeaterHeaders($get('evaluacion_simple')))
                            ->schema([
                                TextInput::make('nombre')
                                    ->required()
                                    ->maxLength(100),
                                Textarea::make('descripcion')
                                    ->maxLength(200),
                                TextInput::make('valor')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0.1)
                                    ->maxValue(99.99)
                                    ->visible(fn(Get $get) => !$get('../../evaluacion_simple'))
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, $livewire) {
                                        self::updateTotals($get, $livewire);
                                    })
                                    ->suffix('%'),
                            ])
                            ->live()
                            ->afterStateUpdated(function (Get $get, $livewire) {
                                self::updateTotals($get, $livewire);
                            })
                            ->afterStateHydrated(function (Get $get, $livewire) {
                                self::updateTotals($get, $livewire);
                            })
                            ->deleteAction(
                                fn(Action $action) => $action->after(fn(Get $get, Component $livewire) => self::updateTotals($get, $livewire)),
                            ),

                    ]),
            ])
            ->statePath('data')
            ->model($this->record);
    }

    // This function updates totals based on the selected products and quantities
    public static function updateTotals(Get $get, Component $livewire): void
    {
        // Retrieve the state path of the form. Most likely it's `data` but it could be something else.
        $statePath = $livewire->getFormStatePath();
        $evaluaciones = data_get($livewire, $statePath . '.evaluacions');
        if (collect($evaluaciones)->isEmpty()) {
            return;
        }
        $selectedProducts = collect($evaluaciones)->filter(fn($item) => !empty ($item['valor']));

        $sumaPorcentajes = $selectedProducts->sum('valor');
        data_set($livewire, $statePath . '.porcentaje_total', number_format($sumaPorcentajes, 2, '.', ''));
    }

    function buildRepeaterHeaders(bool $evaluacion_simple): array
    {
        $headers = [
            Header::make('Nombre')->markAsRequired()->width('200px'),
            Header::make('Descripcion'),
        ];
        if (!$evaluacion_simple) {
            $headers = array_merge($headers, [Header::make('Valor')->width('150px')->markAsRequired()]);
        }
        return $headers;
    }
}
