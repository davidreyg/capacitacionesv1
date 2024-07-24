<?php

namespace App\Filament\Resources\SesionResource\Pages;

use App\Actions\GenerarPdf;
use App\Actions\Sesion\GenerarAsistenciaPorSesion;
use App\Concerns\CustomPageRecord;
use App\Enums\Services\AsistenciaDataSourceType;
use App\Enums\Setting\ReportType;
use App\Filament\Resources\SesionResource;
use App\Models\Sesion;
use App\Services\AsistenciaDataSource\AsistenciaDataSourceFactory;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Illuminate\Database\Eloquent\Model;

class RegistrarSesionAsistencia extends CustomPageRecord
{
    use NestedPage;
    // use InteractsWithRecord;
    protected static string $resource = SesionResource::class;
    protected ?string $heading = 'Asistencia';
    protected static ?string $breadcrumb = 'Asistencia';
    protected ?string $subheading = 'En esta sección podra registrar la asistencia de los alumnos';
    protected static string $view = 'filament.resources.sesion-resource.pages.registrar-sesion-asistencia';

    public $asistencia = [];

    public static function canAccess($parameters = []): bool
    {
        return auth()->user()->can('attendance_sesion');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // $data = [];
        $this->initAsistencia();

        return $data;
    }

    public function initAsistencia()
    {
        if ($this->getRecord()->empleados()->count() > 0) {
            $this->asistencia = $this->getRecord()->empleados->mapWithKeys(function ($empleado) {
                return [$empleado->id => ['is_present' => $empleado->pivot->is_present]];
            })->toArray();
        }
    }

    protected function generarAsistenciaAction(): Action
    {
        return Action::make('generarAsistencia')
            ->label('Generar Asistencia')
            ->requiresConfirmation()
            ->databaseTransaction()
            ->action(function () {
                GenerarAsistenciaPorSesion::make()->handle($this->getRecord());
                $this->initAsistencia();
            });
    }

    public function toggleAsistencia($index)
    {
        // dd($this->data['asistencia'][$index], $index);
        $this->asistencia[$index] = !$this->asistencia[$index];
    }

    protected function handleRecordUpdate(Model $record, array $data): Sesion
    {
        // dd($data, $this->asistencia);
        $this->record->empleados()->sync($this->asistencia);
        return $record;
    }

    function getHeaderActions(): array
    {
        return [
            Action::make('imprimir')
                ->label('Imprimir Formato')
                ->url(fn(Sesion $record): string => route('preview-pdf', [
                    'tipo_reporte' => AsistenciaDataSourceType::DATABASE,
                    'sesion_id' => $record->id
                ]))
                ->openUrlInNewTab()
        ];
    }


}
