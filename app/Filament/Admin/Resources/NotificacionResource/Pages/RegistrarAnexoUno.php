<?php

namespace App\Filament\Admin\Resources\NotificacionResource\Pages;

use App\Enums\AnexoUno\TipoAnexoUno;
use App\Enums\Establecimiento\TipoEstablecimientoEnum;
use App\Filament\Admin\Resources\EstablecimientoResource\Forms\EstablecimientoForm;
use App\Filament\Admin\Resources\EstablecimientoResource\Pages\EditEstablecimiento;
use App\Filament\Admin\Resources\NotificacionResource;
use App\Models\AnexoUno\AnexoUno;
use App\Models\AnexoUno\AnexoUnoActividadEconomica;
use App\Models\Establecimiento;
use App\Models\Notificacion;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
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
        $this->record = AnexoUno::find($record) ?? new AnexoUno();
        $this->parent = $this->resolveRecord($record);
        $this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // dd($data);
        $this->parent->anexoUno()->updateOrCreate($data);

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
            // Step::make('Visibility')
            //     ->description('Control who can view it')
            //     ->schema([
            //         Toggle::make('is_visible')
            //             ->label('Visible to customers.')
            //             ->default(true),
            //     ]),
        ];
    }
}
