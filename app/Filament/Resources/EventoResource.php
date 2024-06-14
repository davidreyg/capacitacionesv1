<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventoResource\Pages;
use App\Filament\Resources\EventoResource\RelationManagers;
use App\Models\Evento;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventoResource extends Resource
{
    protected static ?string $model = Evento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Datos del evento')
                            ->schema([
                                Forms\Components\Split::make([
                                    Forms\Components\Fieldset::make('Vacantes')->schema([
                                        Forms\Components\Toggle::make('libre')
                                            ->label('¿Libre ingreso?')
                                            ->inline(false)
                                            ->live()
                                            ->afterStateUpdated(fn(Forms\Set $set) => $set('vacantes', null))
                                            ->required(),
                                        Forms\Components\TextInput::make('vacantes')
                                            ->required()
                                            ->hidden(fn(Forms\Get $get): bool => !!$get('libre'))
                                            ->required(fn(Forms\Get $get): bool => !!$get('libre'))
                                            ->numeric(),
                                        Forms\Components\Hidden::make('vacantes'),
                                    ])->columns(2),
                                    Forms\Components\Fieldset::make('Proveedor')->schema([
                                        Forms\Components\Select::make('proveedor_id')
                                            ->relationship('proveedor', 'razon_social')
                                            ->required()
                                            ->searchable(),
                                        Forms\Components\DatePicker::make('fecha_orden_servicio')
                                            ->required(),
                                    ])->columns(2),
                                ])->columns(2)->columnSpanFull(),

                                Forms\Components\Fieldset::make('Datos del evento')
                                    ->schema([
                                        Forms\Components\Select::make('modalidad_id')
                                            ->relationship('modalidad', 'nombre')
                                            ->required(),
                                        Forms\Components\Select::make('capacitacion_id')
                                            ->relationship('capacitacion', 'nombre')
                                            ->required()
                                            ->searchable(),

                                        Forms\Components\DatePicker::make('fecha_inicio')
                                            ->required(),
                                        Forms\Components\DatePicker::make('fecha_fin')
                                            ->required(),

                                        Forms\Components\TextInput::make('lugar')
                                            ->required()
                                            ->maxLength(100),

                                        Forms\Components\TextInput::make('estado')
                                            ->required()
                                            ->visibleOn('edit')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),

                            ])
                            ->columns([
                                'default' => 1,
                                'sm' => 2,
                                'md' => 2,
                                'lg' => 3,
                                'xl' => 3,
                            ]),
                        Forms\Components\Tabs\Tab::make('Costos')
                            ->schema([
                                Forms\Components\Split::make([
                                    Forms\Components\Fieldset::make('Costos directos')
                                        ->schema([
                                            TableRepeater::make('costosDirectos')
                                                ->hiddenLabel()
                                                ->relationship()
                                                ->headers([
                                                    Header::make('Costo')->width('150px')->markAsRequired(),
                                                    Header::make('valor')->width('150px'),
                                                ])
                                                ->schema([
                                                    Forms\Components\Select::make('costo_id')
                                                        ->relationship('costo', 'nombre', fn(Builder $query) => $query->where('tipo', 'directo'))
                                                        ->distinct()
                                                        ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                                        ->required(),
                                                    Forms\Components\TextInput::make('valor')->required()->maxLength(2),
                                                ])
                                                ->collapsible()->columnSpanFull()
                                        ]),
                                    Forms\Components\Fieldset::make('Costos indirectos')
                                        ->schema([
                                            TableRepeater::make('costosIndirectos')
                                                ->hiddenLabel()
                                                ->relationship()
                                                ->headers([
                                                    Header::make('Costo')->width('150px')->markAsRequired(),
                                                    Header::make('valor')->width('150px'),
                                                ])
                                                ->schema([
                                                    Forms\Components\Select::make('costo_id')
                                                        ->relationship('costo', 'nombre', fn(Builder $query) => $query->where('tipo', 'indirecto'))
                                                        ->distinct()
                                                        ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                                        ->required(),
                                                    Forms\Components\TextInput::make('valor')->required()->maxLength(2),
                                                ])
                                                ->collapsible()->columnSpanFull()
                                        ])
                                ])->from('md')
                            ]),
                        Forms\Components\Tabs\Tab::make('Tab 3')
                            ->schema([
                                // ...
                            ]),
                    ])
                    ->columnSpanFull(),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_fin')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_orden_servicio')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lugar')
                    ->searchable(),
                Tables\Columns\IconColumn::make('libre')
                    ->boolean(),
                Tables\Columns\TextColumn::make('vacantes')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('modalidad_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('capacitacion_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('proveedor_id')
                    ->numeric()
                    ->sortable(),
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
                Tables\Actions\EditAction::make(),
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
