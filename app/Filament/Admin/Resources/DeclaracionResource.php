<?php

namespace App\Filament\Admin\Resources;

use App\Enums\Declaracion\TipoDeclaranteEnum;
use App\Filament\Admin\Resources\DeclaracionResource\Pages;
use App\Filament\Admin\Resources\DeclaracionResource\RelationManagers;
use App\Models\Declaracion;
use App\Models\Empleado;
use App\Models\Pregunta;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeclaracionResource extends Resource
{
    use NestedResource;
    protected static ?string $model = Declaracion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Datos de la persona / Datos del accidente laboral')
                    ->columns(2)
                    ->schema([
                        Select::make('empleado_id')
                            ->label('Declarante')
                            ->options(Empleado::pluck('nombres', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('tipo_declarante')
                            ->required()
                            ->options(TipoDeclaranteEnum::class),
                        Forms\Components\DatePicker::make('fecha_ocurrencia')
                            ->required(),
                        Forms\Components\TimePicker::make('hora_ocurrencia')
                            ->required(),
                        Forms\Components\TextInput::make('lugar_ocurrencia')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('reportado_jefe_inmediato')
                            ->required(),
                        Select::make('user_id')
                            ->label('Usuario Responsable')
                            ->options(User::pluck('nombre_completo', 'id'))
                            ->searchable()
                            ->required(),
                    ]),
                Section::make('Preguntas.')
                    ->schema([
                        Repeater::make('preguntas')
                            ->hiddenLabel()
                            ->relationship('declaracionPreguntas')
                            ->deletable(false)
                            ->addable(false)
                            ->default(
                                Pregunta::get()->mapWithKeys(
                                    fn($pregunta)
                                    => [
                                        $pregunta->id => [
                                            'respuesta' => '',
                                            'nombre' => $pregunta->nombre,
                                            'pregunta_id' => $pregunta->id
                                        ]
                                    ]
                                )
                            )
                            ->mutateRelationshipDataBeforeFillUsing(function (array $data, Declaracion $record): array {
                                $pregunta = $record->preguntas->find($data['pregunta_id']);
                                $data['nombre'] = $pregunta->nombre;

                                return $data;
                            })
                            ->schema([
                                Textarea::make('respuesta'),
                                Hidden::make('pregunta_id'),
                                Hidden::make('nombre'),
                            ])
                            ->itemLabel(fn(array $state): ?string => $state['nombre'] ?? null),


                    ])
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipo_declarante')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_ocurrencia')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hora_hocurrencia'),
                Tables\Columns\TextColumn::make('lugar_ocurrencia')
                    ->searchable(),
                Tables\Columns\IconColumn::make('reportado_jefe_inmediato')
                    ->boolean(),
                Tables\Columns\TextColumn::make('user_id')
                    ->searchable(),
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
            // 'index' => Pages\ListDeclaracions::route('/'),
            // 'create' => Pages\CreateDeclaracion::route('/create'),
            'edit' => Pages\EditDeclaracion::route('/{record}/edit'),
        ];
    }

    public static function getAncestor(): ?Ancestor
    {
        return Ancestor::make(
            'declaracions',
            'notificacion',
        );
    }
}
