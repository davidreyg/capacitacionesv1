<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CapacitacionResource\Pages;
use App\Filament\Resources\CapacitacionResource\RelationManagers;
use App\Models\Capacitacion;
use App\Models\Item;
use App\Models\Respuesta;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CapacitacionResource extends Resource
{
    protected static ?string $model = Capacitacion::class;
    protected static ?string $pluralModelLabel = 'Capacitaciones';
    protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $navigationIcon = 'tabler-book-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Información General')
                            ->schema([
                                Forms\Components\Select::make('tipo_capacitacion_id')
                                    ->label('Tipo de Capacitación')
                                    ->relationship('tipo_capacitacion', 'nombre')
                                    ->required(),
                                Forms\Components\Select::make('eje_tematico_id')
                                    ->label('Eje tematico')
                                    ->relationship('eje_tematico', 'nombre')
                                    ->required(),
                                Forms\Components\Select::make('oportunidad_id')
                                    ->relationship('oportunidad', 'nombre')
                                    ->required(),
                                Forms\Components\Select::make('nivels')
                                    ->multiple()
                                    ->label('Niveles')
                                    ->relationship(titleAttribute: 'nombre')
                                    ->required()
                                    ->preload(),
                                Forms\Components\TextInput::make('codigo')
                                    ->required()
                                    ->maxLength(20),
                                Forms\Components\TextInput::make('nombre')
                                    ->required()
                                    ->maxLength(225),
                                Forms\Components\TextInput::make('creditos')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('numero_horas')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\Toggle::make('activo')
                                    ->label('¿Activo?')
                                    ->inline(false)
                                    ->required(),

                                Grid::make([
                                    'default' => 1,
                                    'sm' => 2,
                                ])
                                    ->schema([
                                        Forms\Components\Textarea::make('objetivo_aprendizaje')
                                            ->required(),

                                        Forms\Components\Textarea::make('objetivo_desempeño')
                                            ->required(),
                                        Forms\Components\Textarea::make('problema')
                                            ->required(),
                                        Forms\Components\Textarea::make('perfil')

                                    ]),
                            ])->columns([
                                    'default' => 1,
                                    'sm' => 2,
                                    'md' => 2,
                                    'lg' => 3,
                                    'xl' => 3,
                                ]),
                        Tab::make('Información del SERVIR')
                            ->schema([
                                TableRepeater::make('capacitacionRespuestas')
                                    ->relationship()
                                    ->addable(false)
                                    ->deletable(false)
                                    ->default(Item::get()->map(function (Item $item) {
                                        return [
                                            'item_id' => $item->id,    // Suponiendo que 'id' es la clave primaria
                                            'respuesta_id' => null,
                                        ];
                                    })->toArray())
                                    ->mutateRelationshipDataBeforeFillUsing(function (array $data): array {
                                        $data['item_id'] = \DB::table('respuestas')
                                            ->where('id', $data['respuesta_id'])
                                            ->value('item_id');
                                        $data['respuesta_valor'] = \DB::table('respuestas')
                                            ->where('id', $data['respuesta_id'])
                                            ->value('valor');

                                        return $data;
                                    })
                                    ->headers([
                                        Header::make('Item')->markAsRequired(),
                                        Header::make('Respuesta')->markAsRequired(),
                                        Header::make('Valor')->markAsRequired(),
                                    ])
                                    ->schema([
                                        Forms\Components\Select::make('item_id')
                                            ->hiddenLabel()
                                            ->relationship('item', 'nombre')
                                            ->live()
                                            ->disabled()
                                            ->afterStateUpdated(fn(Set $set) => $set('respuesta_id', null))
                                            ->required()
                                            ->dehydrated(false),
                                        Forms\Components\Select::make('respuesta_id')
                                            ->label('Respuesta')
                                            ->options(fn(Get $get) => Respuesta::whereItemId($get('item_id'))->pluck('nombre', 'id'))
                                            ->afterStateUpdated(fn($state, Set $set) => $set('respuesta_valor', \DB::table('respuestas')
                                                ->where('id', $state)
                                                ->value('valor')))
                                            ->live()
                                            ->suffixIconColor('warning')
                                            ->required(),
                                        Forms\Components\TextInput::make('respuesta_valor')
                                            ->disabled()
                                            ->dehydrated(false),

                                    ])
                            ]),
                        Forms\Components\Tabs\Tab::make('Establecimientos solicitantes')
                            ->schema([
                                TableRepeater::make('solicituds')
                                    ->hiddenLabel()
                                    ->addable(false)
                                    ->deletable(false)
                                    ->defaultItems(0)
                                    ->relationship()
                                    ->headers([
                                        Header::make('Nombre')->markAsRequired(),
                                    ])
                                    ->schema([
                                        Forms\Components\Select::make('establecimiento_id')
                                            ->relationship('establecimiento', 'nombre')
                                            ->searchable()
                                            ->required(),
                                    ])
                            ]),
                    ])
                    ->activeTab(1)
                    ->columnSpanFull()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo_capacitacion.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('creditos')
                    ->numeric(),
                Tables\Columns\TextColumn::make('numero_horas')
                    ->numeric(),
                Tables\Columns\IconColumn::make('activo')
                    ->boolean(),
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
            'index' => Pages\ListCapacitacions::route('/'),
            'create' => Pages\CreateCapacitacion::route('/create'),
            'edit' => Pages\EditCapacitacion::route('/{record}/edit'),
        ];
    }
}
