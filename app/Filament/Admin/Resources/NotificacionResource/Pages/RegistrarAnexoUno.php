<?php

namespace App\Filament\Admin\Resources\NotificacionResource\Pages;

use App\Enums\AnexoUno\TipoAnexoUno;
use App\Enums\Establecimiento\TipoEstablecimientoEnum;
use App\Filament\Admin\Resources\EmpleadoResource\Pages\EditEmpleado;
use App\Filament\Admin\Resources\EstablecimientoResource\Forms\EstablecimientoForm;
use App\Filament\Admin\Resources\EstablecimientoResource\Pages\EditEstablecimiento;
use App\Filament\Admin\Resources\NotificacionResource;
use App\Models\AnexoUno\AnexoUno;
use App\Models\AnexoUno\AnexoUnoActividadEconomica;
use App\Models\AnexoUno\AnexoUnoAgenteCausante;
use App\Models\AnexoUno\AnexoUnoCategoriaTrabajador;
use App\Models\AnexoUno\AnexoUnoEnfermedadesTrabajo;
use App\Models\AnexoUno\AnexoUnoFormaAccidente;
use App\Models\AnexoUno\AnexoUnoNaturalezaLesion;
use App\Models\AnexoUno\AnexoUnoParteAfectada;
use App\Models\AnexoUno\Consecuencia;
use App\Models\AnexoUno\Riesgo;
use App\Models\Empleado;
use App\Models\Establecimiento;
use App\Models\Notificacion;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Set;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Enums\IconSize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use JaOcero\RadioDeck\Forms\Components\RadioDeck;
use Livewire\Attributes\Locked;

class RegistrarAnexoUno extends EditRecord
{
    use EditRecord\Concerns\HasWizard;
    protected static string $resource = NotificacionResource::class;

    #[Locked]
    public Model|int|string|null $parent;

    public function mount(int|string $record): void
    {
        $temp = $this->resolveRecord($record);
        $this->record = $temp->anexoUno ?? new AnexoUno();
        // dd($record);
        $this->parent = $this->resolveRecord($record);
        $this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($this->getRecord()->id)) {
            $establecimientoEmpleador = $this->getRecord()->establecimientoEmpleador;
            $establecimientoLaboral = $this->getRecord()->establecimientoLaboral;
            $empleado = $this->getRecord()->empleado;
            $riesgo_ids = $this->getRecord()->riesgos->map(fn($riesgo) => $riesgo->id);
            $consecuencia_ids = $this->getRecord()->consecuencias->map(fn($consecuencia) => $consecuencia->id);
            //setear PASO 1 si ya existe:
            $data['empleador_ruc'] = $establecimientoEmpleador->ruc;
            $data['empleador_direccion'] = $establecimientoEmpleador->direccion;
            $data['empleador_anexo_uno_actividad_economica_id'] = $establecimientoEmpleador->anexo_uno_actividad_economica_id;
            $data['empleador_telefono'] = $establecimientoEmpleador->telefono;
            //setear PASO 2 si ya existe:
            $data['laboral_ruc'] = $establecimientoLaboral->ruc;
            $data['laboral_direccion'] = $establecimientoLaboral->direccion;
            $data['laboral_anexo_uno_actividad_economica_id'] = $establecimientoLaboral->anexo_uno_actividad_economica_id;
            $data['laboral_telefono'] = $establecimientoLaboral->telefono;

            $data['empleado_numero_documento'] = $empleado->numero_documento;
            $data['empleado_direccion'] = $empleado->direccion;
            $data['empleado_anexo_uno_categoria_trabajador_id'] = $empleado->anexo_uno_categoria_trabajador_id;
            $data['empleado_essalud'] = $empleado->essalud;
            $data['empleado_eps'] = $empleado->eps;
            $data['empleado_sexo'] = $empleado->sexo;
            $data['empleado_asegurado'] = $empleado->asegurado;
            $data['empleado_telefono'] = $empleado->telefono;

            $data['riesgo_ids'] = $riesgo_ids;
            $data['consecuencia_ids'] = $consecuencia_ids;

        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $dataSinRelaciones = \Arr::except($data, ['riesgo_ids', 'consecuencia_ids']);
        $record = $this->parent->anexoUno()->updateOrCreate($dataSinRelaciones);
        // Guardar relationships...
        $record->riesgos()->sync($data['riesgo_ids']);
        $record->consecuencias()->sync($data['consecuencia_ids']);
        return $record;
    }

    protected function getSteps(): array
    {
        return [
            Step::make('Datos Generales')
                // ->description('Give the category a clear and unique name')
                ->schema([
                    RadioDeck::make('tipo')
                        ->options(TipoAnexoUno::class)
                        ->descriptions(TipoAnexoUno::class)
                        ->icons(TipoAnexoUno::class)
                        ->required()
                        ->iconSize(IconSize::Large)
                        ->iconPosition(IconPosition::Before)
                        ->alignment(Alignment::Center)
                        ->color('primary')
                        ->columns(2),
                    DatePicker::make('fecha_presentacion')
                        ->required(),
                ]),
            Step::make('Datos del empleador')
                ->schema([
                    Select::make('establecimiento_empleador_id')
                        ->label('Establecimiento')
                        ->options(Establecimiento::where('parent_id', null)->pluck('nombre', 'id'))
                        ->afterStateUpdated(function ($state, Set $set) {
                            $establecimiento = Establecimiento::find($state);
                            if ($establecimiento) {
                                $set('empleador_ruc', $establecimiento->ruc);
                                $set('empleador_direccion', $establecimiento->direccion);
                                $set('empleador_anexo_uno_actividad_economica_id', $establecimiento->anexo_uno_actividad_economica_id);
                                $set('empleador_telefono', $establecimiento->telefono);
                            } else {
                                $set('empleador_ruc', null);
                                $set('empleador_direccion', null);
                                $set('empleador_anexo_uno_actividad_economica_id', null);
                                $set('empleador_telefono', null);
                            }
                        })
                        ->suffixAction(
                            fn($state) => $state ? Action::make('editarEstablecimiento')
                                ->label('Editar')
                                ->visible(fn($state) => !!$state)
                                ->icon('tabler-edit')
                                ->url(EditEstablecimiento::getUrl(['record' => $state]))
                                ->openUrlInNewTab() :
                            Action::make('editarEstablecimiento')
                                ->label('Editar')
                                ->hidden()

                        )
                        ->live(),
                    TextInput::make('empleador_ruc')
                        ->label('Ruc')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('empleador_direccion')
                        ->label('Direccion')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    Select::make('empleador_anexo_uno_actividad_economica_id')
                        ->label('Actividad Economica')
                        ->options(AnexoUnoActividadEconomica::pluck('descripcion', 'id'))
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('empleador_telefono')
                        ->label('Telefono')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                ])->columns(2),
            Step::make('Datos de la empresa donde ejecuta las labores')
                ->schema([
                    Select::make('establecimiento_laboral_id')
                        ->label('Establecimiento')
                        ->options(Establecimiento::where('tipo', TipoEstablecimientoEnum::ESTABLECIMIENTO)->pluck('nombre', 'id'))
                        ->afterStateUpdated(function ($state, Set $set) {
                            $establecimiento = Establecimiento::find($state);
                            if ($establecimiento) {
                                $set('laboral_ruc', $establecimiento->ruc);
                                $set('laboral_direccion', $establecimiento->direccion);
                                $set('laboral_anexo_uno_actividad_economica_id', $establecimiento->anexo_uno_actividad_economica_id);
                                $set('laboral_telefono', $establecimiento->telefono);
                            } else {
                                $set('laboral_ruc', null);
                                $set('laboral_direccion', null);
                                $set('laboral_anexo_uno_actividad_economica_id', null);
                                $set('laboral_telefono', null);
                            }
                        })
                        ->suffixAction(
                            fn($state) => $state ? Action::make('editarEstablecimiento')
                                ->label('Editar')
                                ->visible(fn($state) => !!$state)
                                ->icon('tabler-edit')
                                ->url(EditEstablecimiento::getUrl(['record' => $state]))
                                ->openUrlInNewTab() :
                            Action::make('editarEstablecimiento')
                                ->label('Editar')
                                ->hidden()
                        )
                        ->live(),
                    TextInput::make('laboral_ruc')
                        ->label('ruc')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('laboral_direccion')
                        ->label('Direccion')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    Select::make('laboral_anexo_uno_actividad_economica_id')
                        ->label('Actividad Economica')
                        ->options(AnexoUnoActividadEconomica::pluck('descripcion', 'id'))
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('laboral_telefono')
                        ->label('Telefono')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                ])->columns(2),
            Step::make('Datos del empleado')
                // ->description('Datos del E')
                ->schema([
                    Select::make('empleado_id')
                        ->label('Empleado')
                        ->options(Empleado::pluck('nombres', 'id'))
                        ->afterStateUpdated(function ($state, Set $set) {
                            $empleado = Empleado::find($state);
                            if ($empleado) {
                                $set('empleado_numero_documento', $empleado->numero_documento);
                                $set('empleado_direccion', $empleado->direccion);
                                $set('empleado_anexo_uno_categoria_trabajador_id', $empleado->anexo_uno_categoria_trabajador_id);
                                $set('empleado_essalud', $empleado->essalud);
                                $set('empleado_eps', $empleado->eps);
                                $set('empleado_sexo', $empleado->sexo);
                                $set('empleado_asegurado', $empleado->asegurado);
                                $set('empleado_telefono', $empleado->telefono);
                            } else {
                                $set('empleado_numero_documento', NULL);
                                $set('empleado_direccion', NULL);
                                $set('empleado_anexo_uno_categoria_trabajador_id', NULL);
                                $set('empleado_essalud', NULL);
                                $set('empleado_eps', NULL);
                                $set('empleado_sexo', NULL);
                                $set('empleado_asegurado', NULL);
                                $set('empleado_telefono', NULL);
                            }
                        })
                        ->suffixAction(
                            fn($state) => $state ? Action::make('editarEmpleado')
                                ->label('Editar')
                                ->visible(fn($state) => !!$state)
                                ->icon('tabler-edit')
                                ->url(EditEmpleado::getUrl(['record' => $state]))
                                ->openUrlInNewTab() :
                            Action::make('editarEmpleado')
                                ->label('Editar')
                                ->hidden()
                        )
                        ->live(),
                    TextInput::make('empleado_numero_documento')
                        ->label('N° de documetno')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('empleado_direccion')
                        ->label('Direccion')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    Select::make('empleado_anexo_uno_categoria_trabajador_id')
                        ->label('Categoria Ocupacional')
                        ->options(AnexoUnoCategoriaTrabajador::pluck('descripcion', 'id'))
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('empleado_essalud')
                        ->label('ESSALUD')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('empleado_eps')
                        ->label('EPS')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('empleado_sexo')
                        ->label('Genero')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    Toggle::make('empleado_asegurado')
                        ->label('Asegurado')
                        ->inline(false)
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                ])->columns(2),
            Step::make('Datos del accidente de trabajo')
                // ->description('Control who can view it')
                ->schema([
                    Fieldset::make('Datos Generales')->schema([
                        DateTimePicker::make('fecha_hora_accidente')
                            ->label('Fecha del accidente'),
                        Select::make('anexo_uno_forma_accidente_id')
                            ->label('Forma accidente')
                            ->options(AnexoUnoFormaAccidente::pluck('descripcion', 'id'))
                            ->required(),
                        Select::make('anexo_uno_agente_causante_id')
                            ->label('Agente Causante')
                            ->options(AnexoUnoAgenteCausante::get()->groupBy('grupo')->mapWithKeys(function ($items, $categoria) {
                                return [
                                    $categoria => $items->pluck('descripcion', 'id')->toArray()
                                ];
                            }))
                            ->required(),
                    ]),
                    Fieldset::make('Certificacion Medica')->schema([
                        TextInput::make('accidente_centro_medico_nombre')
                            ->label('Centro Medico')
                            ->required(),
                        TextInput::make('accidente_centro_medico_ruc')
                            ->label('RUC')
                            ->required(),
                        DatePicker::make('accidente_fecha_ingreso')
                            ->required(),
                        Select::make('anexo_uno_parte_afectada_id')
                            ->label('Parte del cuerpo afectado')
                            ->options(AnexoUnoParteAfectada::pluck('descripcion', 'id'))
                            ->required(),
                        Select::make('anexo_uno_naturaleza_lesion_id')
                            ->label('Naturaleza de la lesión')
                            ->options(AnexoUnoNaturalezaLesion::pluck('descripcion', 'id'))
                            ->required(),
                        TextInput::make('accidente_medico_nombre')
                            ->label('Medico')
                            ->required(),
                        TextInput::make('accidente_medico_numero_colegiatura')
                            ->label('N° Colegiatura')
                            ->numeric()
                            ->required(),

                    ]),
                    Fieldset::make('Consecuencias del accidente')
                        ->schema([
                            CheckboxList::make('consecuencia_ids')
                                // ->hiddenLabel()
                                ->options(Consecuencia::pluck('nombre', 'id'))
                                ->required(),

                        ])
                ])->columns(2),
            Step::make('Datos de la enfermedad relacionada al trabajo')
                // ->description('Control who can view it')
                ->schema([
                    Fieldset::make('Datos generales')
                        ->schema([
                            Select::make('anexo_uno_enfermedades_trabajo_id')
                                ->label('Naturaleza de la enfermedad')
                                ->options(AnexoUnoEnfermedadesTrabajo::pluck('descripcion', 'id'))
                                ->required(),
                            CheckboxList::make('riesgo_ids')
                                ->label('Factor de riesgo causante')
                                ->options(Riesgo::pluck('nombre', 'id'))
                                // ->relationship('riesgos', 'nombre')
                                ->columns(3)
                                ->required(),
                        ]),
                    Fieldset::make('Certificacion medica')
                        ->schema([
                            TextInput::make('enfermedad_centro_medico_nombre')
                                ->label('Centro Medico')
                                ->required(),
                            TextInput::make('enfermedad_centro_medico_ruc')
                                ->label('RUC')
                                ->required(),
                            DatePicker::make('enfermedad_fecha_ingreso')
                                ->required(),
                            TextInput::make('enfermedad_medico_nombre')
                                ->label('Medico')
                                ->required(),
                            TextInput::make('enfermedad_medico_numero_colegiatura')
                                ->label('N° Colegiatura')
                                ->numeric()
                                ->required(),
                        ]),
                ]),
        ];
    }
}
