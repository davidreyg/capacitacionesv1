<?php

namespace App\Filament\Admin\Resources\EmpleadoResource\Pages;

use App\Enums\Vacuna\DosisEnum;
use App\Enums\Vacuna\EstadoVacunaEnum;
use App\Filament\Admin\Resources\EmpleadoResource;
use App\Models\Fabricante;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GestionarEmpleadoVacunas extends ManageRelatedRecords
{
    protected static string $resource = EmpleadoResource::class;

    protected static string $relationship = 'vacunas';

    protected static ?string $navigationIcon = 'tabler-vaccine';

    public static function getNavigationLabel(): string
    {
        return 'Vacunas';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    TextInput::make('codigo')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('nombre')
                        ->required()
                        ->maxLength(255),
                ])->visibleOn('create'),
                Group::make([
                    ...self::detalleForm(),
                ])->columns(2)->visibleOn('edit'),
            ])->columns(null);
    }

    public static function detalleForm(): array
    {
        return [
            DatePicker::make('fecha_vacuna')
                ->time(false)
                ->required(),
            Select::make('estado')
                ->options(EstadoVacunaEnum::toArray())
                ->required(),
            Select::make('dosis')
                ->options(DosisEnum::toArray())
                ->required(),
            TextInput::make('edad_atencion')
                ->numeric()
                ->minValue(1)
                ->required(),
            TextInput::make('establecimiento')
                ->maxLength(200)
                ->required(),
            TextInput::make('lote_vacuna')
                ->maxLength(100)
                ->required(),
            Select::make('fabricante_id')
                ->label('Fabricante')
                ->options(Fabricante::pluck('nombre', 'id'))
                ->required(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->defaultSort(null)
            ->columns([
                Tables\Columns\TextColumn::make('establecimiento')->wrap(),
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\TextColumn::make('dosis'),
                Tables\Columns\TextColumn::make('created_at')->date()->label('Fecha de registro'),
                Tables\Columns\TextColumn::make('estado')->badge(),
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
                Tables\Actions\EditAction::make(),
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
