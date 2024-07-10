<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventoResource\Pages;
use App\Filament\Resources\EventoResource\RelationManagers;
use App\Models\Solicitud;
use App\Models\Evento;
use App\States\Solicitud\Solicitado;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconSize;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventoResource extends Resource
{
    protected static ?string $model = Evento::class;
    protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $navigationIcon = 'tabler-calendar-event';

    // Este permiso es para que solo los superusuarios puedan ver TODOS LOS EVENTOS.
    public static function canAccess(): bool
    {
        return auth()->user()->isSuperAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Datos del evento')
                            ->schema([
                                Grid::make()->schema([
                                    Fieldset::make('Información sobre vacantes')->schema([
                                        Toggle::make('libre')
                                            ->label('¿Libre ingreso?')
                                            ->inline(false)
                                            ->live()
                                            ->afterStateUpdated(fn(Forms\Set $set) => $set('vacantes', null))
                                            ->required(),
                                        TextInput::make('vacantes')
                                            // ->label(fn(string $operation): string => $operation === 'create' ? 'Vacantes' : 'Vacantes / Inscripciones')
                                            ->required()
                                            ->hidden(fn(Forms\Get $get): bool => !!$get('libre'))
                                            ->required(fn(Forms\Get $get): bool => !!$get('libre'))
                                            ->numeric(),
                                        Hidden::make('vacantes'),
                                    ])->columnSpan(1)->columns(2),
                                    Fieldset::make('Datos del proveedor')->schema([
                                        Select::make('proveedor_id')
                                            ->relationship('proveedor', 'razon_social')
                                            ->required()
                                            ->searchable()
                                            ->columnSpan([
                                                'default' => 1,
                                                'sm' => 1,
                                                'md' => 2,
                                                'lg' => 2,
                                                'xl' => 2,
                                            ]),
                                        DatePicker::make('fecha_orden_servicio')
                                            ->required(),
                                    ])->columnSpan(2)->columns([
                                                'default' => 1,
                                                'sm' => 2,
                                                'md' => 3,
                                                'lg' => 3,
                                                'xl' => 3,
                                            ]),
                                ])->columns(3),

                                Fieldset::make('Datos del evento')
                                    ->schema([
                                        Select::make('modalidad_id')
                                            ->relationship('modalidad', 'nombre')
                                            ->required(),
                                        Select::make('oportunidad_id')
                                            ->relationship('oportunidad', 'nombre')
                                            ->required(),
                                        Select::make('capacitacion_id')
                                            ->relationship('capacitacion', 'nombre')
                                            ->required()
                                            ->live()
                                            ->searchable(),
                                        TextInput::make('lugar')
                                            ->required()
                                            ->maxLength(100),
                                        TextInput::make('creditos')
                                            ->required()
                                            ->numeric(),
                                        TextInput::make('numero_horas')
                                            ->required()
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                                Fieldset::make('Fecha y Hora')
                                    ->schema([
                                        DatePicker::make('fecha_inicio')
                                            ->minDate(now()->toDateString())
                                            ->required(),
                                        TimePicker::make('hora_inicio')
                                            ->seconds(false)
                                            ->required(),
                                        DatePicker::make('fecha_fin')
                                            ->after('fecha_inicio')
                                            ->required(),
                                        TimePicker::make('hora_fin')
                                            ->seconds(false)
                                            ->after('hora_inicio')
                                            ->required(),
                                    ]),
                            ])
                            ->columns([
                                'default' => 1,
                                'sm' => 2,
                                'md' => 2,
                                'lg' => 3,
                                'xl' => 3,
                            ]),
                        Tab::make('Costos')
                            ->schema([
                                Split::make([
                                    Fieldset::make('Costos directos')
                                        ->schema([
                                            TableRepeater::make('costosDirectos')
                                                ->hiddenLabel()
                                                ->relationship()
                                                ->headers([
                                                    Header::make('Costo')->width('150px')->markAsRequired(),
                                                    Header::make('valor')->width('150px'),
                                                ])
                                                ->schema([
                                                    Select::make('costo_id')
                                                        ->relationship('costo', 'nombre', fn(Builder $query) => $query->where('tipo', 'directo'))
                                                        ->distinct()
                                                        ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                                        ->required(),
                                                    TextInput::make('valor')->required()->maxLength(2),
                                                ])
                                                ->collapsible()->columnSpanFull()
                                        ]),
                                    Fieldset::make('Costos indirectos')
                                        ->schema([
                                            TableRepeater::make('costosIndirectos')
                                                ->hiddenLabel()
                                                ->relationship()
                                                ->headers([
                                                    Header::make('Costo')->width('150px')->markAsRequired(),
                                                    Header::make('valor')->width('150px'),
                                                ])
                                                ->schema([
                                                    Select::make('costo_id')
                                                        ->relationship('costo', 'nombre', fn(Builder $query) => $query->where('tipo', 'indirecto'))
                                                        ->distinct()
                                                        ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                                        ->required(),
                                                    TextInput::make('valor')->required()->maxLength(2),
                                                ])
                                                ->collapsible()->columnSpanFull()
                                        ])
                                ])->from('md')
                            ]),
                        Tab::make('Establecimientos solicitantes')
                            ->visibleOn('create')
                            ->schema([
                                CheckboxList::make('solicitud_ids')
                                    ->label('Establecimientos')
                                    ->visibleOn('create')
                                    ->options(function (Get $get) {
                                        return Solicitud::whereState('estado', Solicitado::class)->whereEventoId(null)->whereCapacitacionId($get('capacitacion_id'))->get()->mapWithKeys(function (Solicitud $solicitud) {
                                            return [$solicitud->id => $solicitud->establecimiento->nombre];    // Suponiendo que 'id' es la clave primaria;
                                        })->toArray();
                                    })
                                    ->required()
                                    ->columns(2),
                            ]),
                        Tab::make('Establecimientos Aprobados')
                            ->visibleOn('edit')
                            ->schema([
                                TableRepeater::make('solicituds')
                                    ->hiddenLabel()
                                    ->visibleOn('edit')
                                    ->deletable(false)
                                    ->addable(false)
                                    ->relationship()
                                    ->headers([
                                        Header::make('Nombre')->markAsRequired(),
                                        Header::make('Estado')->markAsRequired(),
                                    ])
                                    ->schema([
                                        Placeholder::make('establecimiento_nombre')
                                            ->hiddenLabel()
                                            ->content(fn(Get $get): string => \DB::table('establecimientos')
                                                ->where('id', $get('establecimiento_id'))
                                                ->value('nombre')),
                                        ToggleButtons::make('estado')
                                            ->label('Like this post?')
                                            ->options(fn(Solicitud $record): array => $record->estado->transitionableStatesWith('action'))
                                            ->icons(fn(Solicitud $record): array => $record->estado->transitionableStatesWith('icon'))
                                            ->colors(fn(Solicitud $record): array => $record->estado->transitionableStatesWith('color'))
                                            ->visible(fn(?Solicitud $record): bool => !!$record)
                                            ->grouped(),
                                    ])
                            ]),
                        Tab::make('Sesiones / Clases')
                            ->schema([
                                Repeater::make('sesions')
                                    ->hiddenLabel()
                                    ->relationship()
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
                                    ])
                                    ->minItems(1)
                                    ->grid(2)
                                    ->itemLabel(fn(array $state): ?string => $state['nombre'] ?? null),
                            ]),
                    ])
                    ->activeTab(1)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('capacitacion.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_fin')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lugar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vacantes')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->badge()
                    ->formatStateUsing(fn(Evento $record): string => $record->estado->display())
                    ->color(fn(Evento $record): string => $record->estado->color()),
                Tables\Columns\TextColumn::make('modalidad_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ListEventos::route('/'),
            'create' => Pages\CreateEvento::route('/create'),
            'edit' => Pages\EditEvento::route('/{record}/edit'),
        ];
    }
}
