<?php

namespace App\Filament\Admin\Resources\NotificacionResource\Pages;

use App\Enums\AnexoUno\TipoAnexoUno;
use App\Enums\Establecimiento\TipoEstablecimientoEnum;
use App\Enums\RegistroAccidente\CausasGrupoEnum;
use App\Enums\RegistroAccidente\CausasTipoEnum;
use App\Enums\RegistroAccidente\GradoAccidenteEnum;
use App\Enums\RegistroAccidente\GravedadEnum;
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
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Set;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Enums\IconSize;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use JaOcero\RadioDeck\Forms\Components\RadioDeck;
use Livewire\Attributes\Locked;

class RegistroAccidente extends EditRecord
{
    use NestedPage;
    use EditRecord\Concerns\HasWizard;

    protected static string $resource = NotificacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('imprimir')
                ->label('Imprimir')
                ->icon('heroicon-o-printer')
                ->visible(fn(Notificacion $record): bool => !!$record->registroAccidente)
                ->url(fn(Notificacion $record): string => route('registro-accidente-pdf', [
                    'id' => $record->registroAccidente ? $record->registroAccidente->id : null
                ]))
                ->openUrlInNewTab(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $registroAccidente = $this->getRecord()->registroAccidente;
        // dd($registroAccidente->id);
        if (isset($registroAccidente->id)) {
            $establecimientoPrincipal = $registroAccidente->establecimientoPrincipal;
            $establecimientoIntermediario = $registroAccidente->establecimientoIntermediario;
            $empleado = $registroAccidente->empleado;
            $registroAccidenteCausaBasicas = $registroAccidente->registroAccidenteCausaBasicas;
            $registroAccidenteCausaInmediatas = $registroAccidente->registroAccidenteCausaInmediatas;
            $registroAccidenteMedidas = $registroAccidente->registroAccidenteMedidas;
            $registroAccidenteResponsables = $registroAccidente->registroAccidenteResponsables;
            // $consecuencia_ids = $registroAccidente->consecuencias->map(fn($consecuencia) => $consecuencia->id);

            // $data['tipo'] = $registroAccidente->tipo;
            // $data['fecha_presentacion'] = $registroAccidente->fecha_presentacion;

            //setear PASO 1 si ya existe:
            $data['establecimiento_principal_id'] = $establecimientoPrincipal->id;
            $data['principal_ruc'] = $establecimientoPrincipal->ruc;
            $data['principal_direccion'] = $establecimientoPrincipal->direccion;
            $data['principal_anexo_uno_actividad_economica_id'] = $establecimientoPrincipal->anexo_uno_actividad_economica_id;
            $data['principal_telefono'] = $establecimientoPrincipal->telefono;

            $data['principal_trabajadores_sctr'] = $registroAccidente->principal_trabajadores_sctr;
            $data['principal_trabajadores_no_sctr'] = $registroAccidente->principal_trabajadores_no_sctr;
            $data['principal_nombre_aseguradora'] = $registroAccidente->principal_nombre_aseguradora;

            //setear PASO 2 si ya existe:
            $data['establecimiento_intermediario_id'] = $establecimientoIntermediario->id;
            $data['intermediario_ruc'] = $establecimientoIntermediario->ruc;
            $data['intermediario_direccion'] = $establecimientoIntermediario->direccion;
            $data['intermediario_anexo_uno_actividad_economica_id'] = $establecimientoIntermediario->anexo_uno_actividad_economica_id;
            $data['intermediario_telefono'] = $establecimientoIntermediario->telefono;

            $data['intermediario_trabajadores_sctr'] = $registroAccidente->intermediario_trabajadores_sctr;
            $data['intermediario_trabajadores_no_sctr'] = $registroAccidente->intermediario_trabajadores_no_sctr;
            $data['intermediario_nombre_aseguradora'] = $registroAccidente->principal_nombre_aseguradora;

            // PASO 3
            $data['empleado_numero_documento'] = $empleado->numero_documento;
            $data['empleado_antiguedad_puesto'] = $empleado->antiguedad_puesto;
            $data['empleado_turno'] = $empleado->turno;
            $data['empleado_tiempo_experiencia'] = $empleado->tiempo_experiencia;
            $data['empleado_sexo'] = $empleado->sexo;

            //PASO 4 INVESTIGAICON DEL ACCIDENTE DE TRABAJO
            $data['fecha_hora_accidente'] = $registroAccidente->fecha_hora_accidente;
            $data['fecha_inicio_investigacion'] = $registroAccidente->fecha_inicio_investigacion;
            $data['lugar_accidente'] = $registroAccidente->lugar_accidente;
            $data['gravedad_accidente'] = $registroAccidente->gravedad_accidente;
            $data['grado_accidente'] = $registroAccidente->grado_accidente;
            $data['dias_descanso'] = $registroAccidente->dias_descanso;
            $data['trabajadores_afectados'] = $registroAccidente->trabajadores_afectados;
            $data['parte_cuerpo_lesionado'] = $registroAccidente->parte_cuerpo_lesionado;
            $data['descripcion'] = $registroAccidente->descripcion;

            // paso  6
            $data['registroAccidenteCausaBasicas'] = $registroAccidenteCausaBasicas;
            $data['registroAccidenteCausaInmediatas'] = $registroAccidenteCausaInmediatas;
            $data['registroAccidenteMedidas'] = $registroAccidenteMedidas;
            $data['registroAccidenteResponsables'] = $registroAccidenteResponsables;

        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // dd($data);
        // $x->registroAccidente()->update
        $dataSinRelaciones = \Arr::except(
            $data,
            ['registroAccidenteCausaBasicas', 'registroAccidenteCausaInmediatas', 'registroAccidenteMedidas', 'registroAccidenteResponsables']
        );

        if ($this->getRecord()->registroAccidente) {
            $this->getRecord()->registroAccidente()->update($dataSinRelaciones);
            $record = $this->getRecord()->registroAccidente;
        } else {
            $record = $this->getRecord()->registroAccidente()->updateOrCreate($dataSinRelaciones);
        }
        // Guardar relationships...
        $record->registroAccidenteCausaBasicas()->delete();
        foreach ($data['registroAccidenteCausaBasicas'] as $dato) {
            $record->registroAccidenteCausaBasicas()->create([
                'descripcion' => $dato['descripcion'],
                'tipo' => $dato['tipo'],
                'grupo' => $dato['grupo'],
                // Añade otros atributos necesarios
            ]);
        }
        $record->registroAccidenteCausaInmediatas()->delete();
        foreach ($data['registroAccidenteCausaInmediatas'] as $dato) {
            $record->registroAccidenteCausaInmediatas()->create([
                'descripcion' => $dato['descripcion'],
                'tipo' => $dato['tipo'],
                'grupo' => $dato['grupo'],
                // Añade otros atributos necesarios
            ]);
        }
        $record->registroAccidenteMedidas()->delete();
        foreach ($data['registroAccidenteMedidas'] as $dato) {
            $record->registroAccidenteMedidas()->create([
                'nombre' => $dato['nombre'],
                'responsable' => $dato['responsable'],
                'fecha_ejecucion' => $dato['fecha_ejecucion'],
                'estado' => $dato['estado'],
                // Añade otros atributos necesarios
            ]);
        }

        $record->registroAccidenteResponsables()->delete();
        foreach ($data['registroAccidenteResponsables'] as $dato) {
            $record->registroAccidenteResponsables()->create([
                'empleado_id' => $dato['empleado_id'],
                'fecha' => $dato['fecha'],
            ]);
        }
        // $record->consecuencias()->sync($data['consecuencia_ids']);
        return $record;
    }

    protected function getSteps(): array
    {
        return [
            Step::make('Datos del principal principal')
                ->schema([
                    Select::make('establecimiento_principal_id')
                        ->label('Establecimiento')
                        ->options(Establecimiento::where('parent_id', null)->pluck('nombre', 'id'))
                        ->afterStateUpdated(function ($state, Set $set) {
                            $establecimiento = Establecimiento::find($state);
                            if ($establecimiento) {
                                $set('principal_ruc', $establecimiento->ruc);
                                $set('principal_direccion', $establecimiento->direccion);
                                $set('principal_anexo_uno_actividad_economica_id', $establecimiento->anexo_uno_actividad_economica_id);
                            } else {
                                $set('principal_ruc', null);
                                $set('principal_direccion', null);
                                $set('principal_anexo_uno_actividad_economica_id', null);
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
                    TextInput::make('principal_ruc')
                        ->label('Ruc')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('principal_direccion')
                        ->label('Direccion')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    Select::make('principal_anexo_uno_actividad_economica_id')
                        ->label('Actividad Economica')
                        ->options(AnexoUnoActividadEconomica::pluck('descripcion', 'id'))
                        ->dehydrated()
                        ->disabled()
                        ->required(),

                    Section::make('COMPLETAR SOLO EN CASO QUE LAS ACTIVIDADES DEL EMPLEADOR SEAN CONSIDERADAS DE ALTO RIESGO')
                        ->schema([
                            TextInput::make('principal_trabajadores_sctr')
                                ->label('N° trabajdores afiliados al SCTR')
                                ->numeric()
                                ->minValue(0)
                                ->nullable(),
                            TextInput::make('principal_trabajadores_no_sctr')
                                ->label('N° trabajdores NO afiliados al SCTR')
                                ->numeric()
                                ->minValue(0)
                                ->nullable(),
                            TextInput::make('principal_nombre_aseguradora')
                                ->label('Nombre aseguradora')
                                ->nullable(),
                        ])->columns(3)
                ])->columns(2),
            Step::make('Datos del principal de intermediario')
                ->schema([
                    Select::make('establecimiento_intermediario_id')
                        ->label('Establecimiento')
                        ->options(Establecimiento::where('tipo', TipoEstablecimientoEnum::ESTABLECIMIENTO)->pluck('nombre', 'id'))
                        ->afterStateUpdated(function ($state, Set $set) {
                            $establecimiento = Establecimiento::find($state);
                            if ($establecimiento) {
                                $set('intermediario_ruc', $establecimiento->ruc);
                                $set('intermediario_direccion', $establecimiento->direccion);
                                $set('intermediario_anexo_uno_actividad_economica_id', $establecimiento->anexo_uno_actividad_economica_id);
                            } else {
                                $set('intermediario_ruc', null);
                                $set('intermediario_direccion', null);
                                $set('intermediario_anexo_uno_actividad_economica_id', null);
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
                    TextInput::make('intermediario_ruc')
                        ->label('ruc')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('intermediario_direccion')
                        ->label('Direccion')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    Select::make('intermediario_anexo_uno_actividad_economica_id')
                        ->label('Actividad Economica')
                        ->options(AnexoUnoActividadEconomica::pluck('descripcion', 'id'))
                        ->dehydrated()
                        ->disabled()
                        ->required(),

                    Section::make('COMPLETAR SOLO EN CASO QUE LAS ACTIVIDADES DEL EMPLEADOR SEAN CONSIDERADAS DE ALTO RIESGO')
                        ->schema([
                            TextInput::make('intermediario_trabajadores_sctr')
                                ->label('N° trabajdores afiliados al SCTR')
                                ->numeric()
                                ->minValue(0)
                                ->nullable(),
                            TextInput::make('intermediario_trabajadores_no_sctr')
                                ->label('N° trabajdores NO afiliados al SCTR')
                                ->numeric()
                                ->minValue(0)
                                ->nullable(),
                            TextInput::make('intermediario_nombre_aseguradora')
                                ->label('Nombre aseguradora')
                                ->nullable(),
                        ])->columns(3)
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
                                $set('empleado_sexo', $empleado->sexo);
                                $set('empleado_antiguedad_puesto', $empleado->antiguedad_puesto);
                                $set('empleado_turno', $empleado->turno);
                                $set('empleado_tiempo_experiencia', $empleado->tiempo_experiencia);
                            } else {
                                $set('empleado_numero_documento', NULL);
                                $set('empleado_sexo', NULL);
                                $set('empleado_antiguedad_puesto', NULL);
                                $set('empleado_turno', NULL);
                                $set('empleado_tiempo_experiencia', NULL);
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
                        ->label('N° de documento')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('empleado_sexo')
                        ->label('Genero')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('empleado_antiguedad_puesto')
                        ->label('Antiguedad en el puesto')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('empleado_turno')
                        ->label('Turno')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                    TextInput::make('empleado_tiempo_experiencia')
                        ->label('Tiempo de experiencia en el puesto')
                        ->dehydrated()
                        ->disabled()
                        ->required(),
                ])->columns(2),
            Step::make('Investigacion del accidente de trabajo')
                // ->description('Control who can view it')
                ->schema([
                    DateTimePicker::make('fecha_hora_accidente')
                        ->label('Fecha del accidente'),
                    DatePicker::make('fecha_inicio_investigacion'),
                    TextInput::make('lugar_accidente')
                        ->label('Genero')
                        ->required(),
                    Select::make('gravedad_accidente')
                        ->label('Gravedad del accidente de trabajo')
                        ->options(GravedadEnum::class)
                        ->required(),
                    Select::make('grado_accidente')
                        ->label('Grado del accidente incapacitante')
                        ->options(GradoAccidenteEnum::class)
                        ->required(),
                    TextInput::make('dias_descanso')
                        ->label('N° dias de descanso medico')
                        ->numeric()
                        ->required(),
                    TextInput::make('trabajadores_afectados')
                        ->label('N° trabajadores afectados')
                        ->numeric()
                        ->required(),
                    TextInput::make('parte_cuerpo_lesionado')
                        ->label('Parte del cuerpo lesionado')
                        ->nullable(),
                ])->columns(2),
            Step::make('Descripcion del accidente de trabajo')
                ->schema([
                    Textarea::make('descripcion')
                        ->nullable()
                ]),
            Step::make('Descripcion de causas que originaron el accidente de trabajo')
                ->schema([
                    Repeater::make('registroAccidenteCausaBasicas')
                        // ->relationship('registroAccidenteCausaBasica')
                        ->schema([
                            Select::make('tipo')
                                ->options(CausasTipoEnum::class)
                                ->required(),
                            Textarea::make('descripcion')->required(),
                            Hidden::make('grupo')->default(CausasGrupoEnum::CAUSAS_BASICAS),
                        ]),
                    Repeater::make('registroAccidenteCausaInmediatas')
                        // ->relationship('registroAccidenteCausaInmediata')
                        ->schema([
                            Select::make('tipo')
                                ->options(CausasTipoEnum::class)
                                ->required(),
                            Textarea::make('descripcion')->required(),
                            Hidden::make('grupo')->default(CausasGrupoEnum::CAUSAS_INMEDIATAS),
                        ])
                ])->columns(2),
            Step::make('Medidas correctivas')
                ->schema([
                    Repeater::make('registroAccidenteMedidas')
                        ->hiddenLabel()
                        ->schema([
                            TextInput::make('nombre')->required(),
                            TextInput::make('responsable')->required(),
                            DatePicker::make('fecha_ejecucion')->required(),
                            TextInput::make('estado')->required(),
                        ])
                        ->required()
                        ->columns(4)
                ]),
            Step::make('Responsable del registro y la investigacion')
                ->schema([
                    Repeater::make('registroAccidenteResponsables')
                        ->hiddenLabel()
                        ->schema([
                            Select::make('empleado_id')
                                ->options(Empleado::pluck('nombres', 'id'))
                                ->searchable(['nombres'])
                                ->required(),
                            DatePicker::make('fecha')
                                ->required(),
                        ])
                        ->required()
                        ->columns(2)
                ]),
        ];
    }
}
