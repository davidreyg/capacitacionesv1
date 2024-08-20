<?php

namespace App\Filament\Admin\Resources;

use App\Enums\Notificacion\TipoAfectacion;
use App\Enums\Notificacion\TipoNotificacion;
use App\Filament\Admin\Resources\NotificacionResource\Pages;
use App\Filament\Admin\Resources\NotificacionResource\RelationManagers;
use App\Models\Empleado;
use App\Models\Notificacion;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificacionResource extends Resource
{
    protected static ?string $model = Notificacion::class;
    protected static ?string $pluralModelLabel = 'Notificaciones';
    protected static ?string $navigationIcon = 'tabler-walk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información General')
                    ->schema([
                        TextInput::make('codigo')->maxLength(100)->required(),
                        Select::make('tipo_notificacion')
                            ->label('Tipo de Notificacion')
                            ->options(TipoNotificacion::toArray())
                            ->required(),
                        TextInput::make('fecha')->type('date')->required(),
                        TimePicker::make('hora')->seconds(false)->required(),
                        TextInput::make('lugar')->maxLength(100)->required()->columnSpan(2),
                        Select::make('tipo_afectacion')
                            ->label('El accidente/incidente afectó o pudo afectar')
                            ->options(TipoAfectacion::toArray())
                            ->required()
                            ->columnSpan(2),

                        Textarea::make('descripcion_situacion')
                            ->label('Describa brevemente qué paso o cómo ocurrió el accidente o incidente')
                            ->columnSpan(2)
                            ->required()
                            ->maxLength(255),
                        Textarea::make('descripcion_lesion')
                            ->label('Describa qué lesión sufrió la persona afectada o qué consecuencias se pudieron dar')
                            ->columnSpan(2)
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Group::make()->schema([
                    Section::make('Testigos')
                        ->description('Testigos del incidente o accidente: En caso existan o se requieran')
                        ->schema([
                            Repeater::make('testigos')
                                ->hiddenLabel()
                                ->relationship()
                                ->simple(TextInput::make('nombre_completo')->required())
                                ->defaultItems(0)
                                ->maxItems(2)
                                ->addActionLabel('Añadir testigo'),
                        ]),
                    Section::make('Reportante')
                        ->schema([
                            Select::make('reportante_id')->hiddenLabel()
                                ->options(function (?Notificacion $record, Get $get, Set $set) {
                                    if ($get('reportante_id')) {
                                        $empleado = Empleado::find($get('reportante_id'))->load(['cargo', 'unidadOrganica']);
                                        $set('reportante_cargo', $empleado->cargo->nombre);
                                    } else {
                                        $set('reportante_cargo', null);
                                    }
                                    return Empleado::fromAuthEstablecimiento()->pluck('nombres', 'id');
                                })
                                ->searchable()
                                ->required()
                                ->live(),
                            Placeholder::make('reportante_cargo')
                                ->label('Cargo')
                                ->content(fn($state): ?string => $state),
                        ])

                ])->columnSpan(1),
                Section::make('Información del Involucrado')->description('')->schema([
                    Select::make('empleado_id')
                        ->options(function (?Notificacion $record, Get $get, Set $set) {
                            if ($get('empleado_id')) {
                                $empleado = Empleado::find($get('empleado_id'))->load(['cargo', 'unidadOrganica']);
                                $set('cargo', $empleado->cargo->nombre);
                                $set('unidad_organica', $empleado->unidadOrganica->nombre);
                            } else {
                                $set('cargo', null);
                                $set('unidad_organica', null);
                            }
                            return Empleado::fromAuthEstablecimiento()->pluck('nombres', 'id');
                        })
                        ->searchable()
                        ->live(),
                    Placeholder::make('cargo')
                        ->content(fn($state): ?string => $state),
                    Placeholder::make('unidad_organica')
                        ->content(fn($state): ?string => $state),
                ])->columns(2)->columnSpan(2),
                Section::make('Fotografías')
                    ->description('Inserte fotografías para ilustrar el evento en la medida que sea posible (recreación del evento)')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('media')
                            ->hiddenLabel()
                            ->maxFiles(2)
                            ->multiple()
                            ->collection('evidencia')
                            ->alignCenter()
                            ->columnSpanFull(),
                    ])->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo')->wrap(),
                TextColumn::make('fecha')->date(),
                TextColumn::make('tipo_notificacion')->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('evaluar')->url(fn(Notificacion $record) => Pages\EvaluarNotificacion::getUrl(['record' => $record])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotificacions::route('/'),
            'create' => Pages\CreateNotificacion::route('/create'),
            'edit' => Pages\EditNotificacion::route('/{record}/edit'),
            'evaluar-notificacion' => Pages\EvaluarNotificacion::route('/{record}/evaluar'),
        ];
    }
}
