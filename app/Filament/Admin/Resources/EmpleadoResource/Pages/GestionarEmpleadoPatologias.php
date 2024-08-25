<?php

namespace App\Filament\Admin\Resources\EmpleadoResource\Pages;

use App\Filament\Admin\Resources\EmpleadoResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
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
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('descripcion')
                    // ->required()
                    ->maxLength(255),
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
                    ->modalWidth(MaxWidth::Large),
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
