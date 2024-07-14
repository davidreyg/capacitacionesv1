<?php

namespace App\Filament\Resources\EventoResource\Pages;

use App\Concerns\CustomPageRecord;
use App\Filament\Resources\EventoResource;
use Filament\Forms\Form;

class GestionarEventoEvaluacions extends CustomPageRecord
{
    protected static string $resource = EventoResource::class;
    protected ?string $heading = 'Evaluaciones de los estudiantes';
    protected static ?string $breadcrumb = 'Evaluaciones de los estudiantes';
    protected ?string $subheading = 'En esta sección podra registrar las notas de los estudiantes';
    protected static ?string $navigationIcon = 'tabler-school';
    protected static string $view = 'filament.resources.evento-resource.pages.gestionar-evento-evaluaciones';

    public static function getNavigationLabel(): string
    {
        return 'Evaluaciones de los estudiantes';
    }

    public function form(Form $form): Form
    {
        return $form->schema([]);
    }

    // TODO: Falta realizar este permiso!
    public static function canAccess($parameters = []): bool
    {
        return true;
    }
}
