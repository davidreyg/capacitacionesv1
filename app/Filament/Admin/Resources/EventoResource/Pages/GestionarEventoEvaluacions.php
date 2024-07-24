<?php

namespace App\Filament\Admin\Resources\EventoResource\Pages;

use App\Actions\Evento\GenerarEvaluacionesPorCriterio;
use App\Actions\Evento\ObtenerEvaluacionesPorEvento;
use App\Filament\Admin\Resources\EventoResource;
use App\Models\Evaluacion;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class GestionarEventoEvaluacions extends Page
{
    use InteractsWithRecord;
    protected static string $resource = EventoResource::class;
    protected ?string $heading = 'Evaluaciones';
    protected static ?string $breadcrumb = 'Evaluaciones';
    protected ?string $subheading = 'En esta sección podra registrar las notas';
    protected static ?string $navigationIcon = 'tabler-school';
    protected static string $view = 'filament.resources.evento-resource.pages.gestionar-evento-evaluaciones';

    public $criterioSeleccionado;
    public array $data = [];
    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public static function getNavigationLabel(): string
    {
        return 'Evaluaciones';
    }

    public function form(Form $form): Form
    {
        return $form->schema([])->model($this->record);
    }

    // TODO: Falta realizar este permiso!
    public static function canAccess($parameters = []): bool
    {
        return true;
    }

    protected function generarEvaluacionAction(): Action
    {
        return Action::make('generarEvaluacion')
            ->label('Generar Evaluacion')
            ->requiresConfirmation()
            ->databaseTransaction()
            ->action(function () {
                $primerCriterio = $this->getRecord()->criterioEvaluacions()->value('id');
                if (isset($primerCriterio)) {
                    GenerarEvaluacionesPorCriterio::make()->handle($this->getRecord(), $primerCriterio);
                } else {
                    Notification::make()
                        ->title("No ha configurado sus criterios de evaluación.")
                        ->warning()
                        ->send();
                    $this->halt();
                }
            });
    }

    public function editarCriterioEvaluacion(int $id): void
    {
        $this->resetErrorBag();
        try {
            $notasDelCriterio = $this->getRecord()->evaluacions()
                ->where('criterio_evaluacion_id', $id)->get();

            if ($notasDelCriterio->isEmpty()) {
                GenerarEvaluacionesPorCriterio::make()->handle($this->getRecord(), $id);
            }
            $notasDelCriterio = $this->getRecord()->evaluacions()
                ->where('criterio_evaluacion_id', $id)->get();
            $this->data = $notasDelCriterio
                ->mapWithKeys(fn($evaluacion) =>
                    [
                        $evaluacion->empleado_id =>
                            [
                                'nota' => $evaluacion->nota,
                                'empleado_id' => $evaluacion->empleado_id,
                                'criterio_evaluacion_id' => $evaluacion->criterio_evaluacion_id,
                                'evaluacion_id' => $evaluacion->id,
                            ]
                    ])
                ->toArray();
            $this->criterioSeleccionado = $id;
        } catch (\Throwable $th) {
            Notification::make()
                ->title($th->getMessage())
                ->danger()
                ->send();
            // throw $th;
        }

    }

    public function guardarCriterioEvaluacion(int $id): void
    {
        // return;
        $request = [
            'data' => $this->data
        ];
        // dd($request);
        $validator = Validator::make($request, [
            'data' => 'required|array',
            'data.*.nota' => 'required|numeric|min:0|max:20',
        ], attributes: [
            'data.*.nota' => 'nota',
        ]);
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->messages()->toArray());
        }
        \DB::transaction(function () {
            foreach ($this->data as $row) {
                Evaluacion::whereId($row['evaluacion_id'])->update(['nota' => $row['nota']]);
            }
        });
        $this->resetErrorBag();
        $this->criterioSeleccionado = null;
    }

    public function cancelarEdicionCriterioEvaluacion()
    {
        $this->resetErrorBag();
        $this->criterioSeleccionado = null;
    }
}
