<?php

namespace App\Filament\Resources\EventoResource\Pages;

use App\Actions\Evento\GenerarEvaluaciones;
use App\Actions\Evento\ObtenerEvaluacionesPorEvento;
use App\Filament\Resources\EventoResource;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class GestionarEventoEvaluacions extends Page
{
    use InteractsWithRecord;
    protected static string $resource = EventoResource::class;
    protected ?string $heading = 'Evaluaciones de los estudiantes';
    protected static ?string $breadcrumb = 'Evaluaciones de los estudiantes';
    protected ?string $subheading = 'En esta sección podra registrar las notas de los estudiantes';
    protected static ?string $navigationIcon = 'tabler-school';
    protected static string $view = 'filament.resources.evento-resource.pages.gestionar-evento-evaluaciones';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public static function getNavigationLabel(): string
    {
        return 'Evaluaciones de los estudiantes';
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
            ->action(fn() => GenerarEvaluaciones::make()->handle($this->getRecord()));
    }
}
