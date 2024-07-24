<?php

namespace App\Filament\Admin\Resources\MisEventosResource\Pages;

use App\Filament\Admin\Resources\MisEventosResource;
use App\Models\Empleado;
use App\Models\Evento;
use App\Models\Sesion;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GestionarSesiones extends ManageRelatedRecords
{
    protected static string $resource = MisEventosResource::class;

    protected static string $relationship = 'sesions';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Sesions';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(100),
                RichEditor::make('descripcion')
                    ->nullable(),
                DatePicker::make('fecha')
                    ->required(),
                TimePicker::make('hora')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                Tables\Columns\TextColumn::make('nombre'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('Asistencia')
                    ->fillForm(fn(Sesion $record): array => [
                        'empleado_evento' => $record->empleados()->where('establecimiento_id', auth()->user()->establecimiento_id)->count() === 0 ?
                            $record->evento->empleados()->where('establecimiento_id', auth()->user()->establecimiento_id)->get()->map(function (Empleado $empleado) {
                                return ['empleado_id' => $empleado->id, 'is_present' => true];
                            }) : $record->empleados()->where('establecimiento_id', auth()->user()->establecimiento_id)->get()->map(function (Empleado $empleado) {
                                return ['empleado_id' => $empleado->id, 'is_present' => $empleado->pivot->is_present];
                            }),
                    ])
                    ->form([
                        TableRepeater::make('empleado_evento')
                            ->hiddenLabel()
                            ->deletable(false)
                            ->addable(false)
                            ->headers([
                                Header::make('Nombre')->markAsRequired(),
                                Header::make('Asistencia')->markAsRequired(),
                            ])
                            ->schema([
                                Select::make('empleado_id')
                                    ->options(Empleado::whereEstablecimientoId(auth()->user()->establecimiento_id)->get()->pluck('nombres', 'id'))
                                    ->distinct()
                                    ->searchable()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->required(),
                                Checkbox::make('is_present'),
                            ])
                    ])
                    ->action(function (array $data, Sesion $record): void {

                        // Preparar datos para sincronización
                        $empleadosPivot = [];
                        foreach ($data['empleado_evento'] as $pivot) {
                            $empleadosPivot[$pivot['empleado_id']] = ['is_present' => $pivot['is_present']];
                        }
                        $record->empleados()->syncWithoutDetaching($empleadosPivot);
                        Notification::make()
                            ->title('Asistencia registrada correctamente.')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
