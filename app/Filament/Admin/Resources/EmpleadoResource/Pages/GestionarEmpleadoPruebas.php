<?php

namespace App\Filament\Admin\Resources\EmpleadoResource\Pages;

use App\Enums\Prueba\ResultadoEnum;
use App\Filament\Admin\Resources\EmpleadoResource;
use App\Models\Laboratorio\MetodoPrueba;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GestionarEmpleadoPruebas extends ManageRelatedRecords
{
    protected static string $resource = EmpleadoResource::class;

    protected static string $relationship = 'pruebas';

    protected static ?string $navigationIcon = 'tabler-flask';

    public static function getNavigationLabel(): string
    {
        return 'Pruebas';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    TextInput::make('nombre')
                        ->required()
                        ->maxLength(100),
                ])->visibleOn('create'),
                Group::make([
                    ...self::detalleForm(),
                ])->columns(2)->visibleOn('edit'),
            ])->columns(null);
    }

    public static function detalleForm(): array
    {
        return [
            DatePicker::make('fecha_aislamiento')
                ->time(false)
                ->required(),
            DatePicker::make('fecha_resultado')
                ->time(false)
                ->required(),
            Select::make('metodo_prueba_id')
                ->label('Metodo de Prueba')
                ->options(MetodoPrueba::pluck('nombre', 'id'))
                ->required(),
            Select::make('resultado')
                ->options(ResultadoEnum::toArray())
                ->required(),
            TextInput::make('dias_aislamiento')
                ->numeric()
                ->minValue(1)
                ->required(),
            RichEditor::make('observaciones'),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->defaultSort('fecha_resultado')
            ->columns([
                Tables\Columns\TextColumn::make('fecha_resultado'),
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\TextColumn::make('resultado')->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth(MaxWidth::Medium)
                    ->using(function (array $data, string $model) {
                        return $model::create($data);
                    }),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->modalWidth(MaxWidth::ThreeExtraLarge)
                    ->form(fn(Tables\Actions\AttachAction $action): array => [
                        Group::make([
                            $action->getRecordSelect()->hiddenLabel(false)->label('Prueba'),
                            ...self::detalleForm(),
                        ])->columns(2),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalWidth(MaxWidth::ThreeExtraLarge),
                Tables\Actions\DetachAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
