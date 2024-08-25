<?php

namespace App\Filament\Admin\Resources\EmpleadoResource\Pages;

use App\Filament\Admin\Resources\EmpleadoResource;
use App\Filament\Admin\Resources\PatologiaResource;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GestionarEmpleadoPatologias extends ManageRelatedRecords
{
    protected static string $resource = EmpleadoResource::class;

    protected static string $relationship = 'patologias';

    protected static ?string $navigationIcon = 'tabler-disabled';

    public static function getNavigationLabel(): string
    {
        return 'Patologias';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    ...PatologiaResource::patologiaForm(),
                ])->visibleOn('create'),
                Group::make([
                    DatePicker::make('fecha_diagnostico')
                        ->time(false)
                        ->required(),
                    TextInput::make('edad_diagnostico')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(126)
                        ->required(),
                    RichEditor::make('tratamiento')->columnSpanFull(),
                ])->columns(2)->visibleOn('edit')

            ])->columns(null);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->defaultSort('patologias.id')
            ->columns([
                Tables\Columns\TextColumn::make('fecha_diagnostico')->date(),
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\TextColumn::make('edad_diagnostico'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth(MaxWidth::Large)
                    ->using(function (array $data, string $model) {
                        return $model::create($data);
                    }),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->modalWidth(MaxWidth::ThreeExtraLarge)
                    ->form(fn(Tables\Actions\AttachAction $action): array => [
                        Group::make([
                            $action->getRecordSelect()->hiddenLabel(false)->label('Patologia'),
                            DatePicker::make('fecha_diagnostico')
                                ->time(false)
                                ->required(),
                            TextInput::make('edad_diagnostico')
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(126)
                                ->required(),
                            TextInput::make('tratamiento'),
                        ])->columns(2),
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalWidth(MaxWidth::Large),
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
