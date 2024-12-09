<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PeriodoResource\Pages;
use App\Filament\Admin\Resources\PeriodoResource\RelationManagers;
use App\Models\Periodo;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeriodoResource extends Resource
{
    protected static ?string $model = Periodo::class;
    protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('año')
                    ->label('Año')
                    ->options(Periodo::años())
                    ->required(),
                Forms\Components\Select::make('mes')
                    ->label('Mes')
                    ->options(Periodo::meses())
                    ->required(),
                Forms\Components\TextInput::make('horas_trabajadas')
                    ->required()
                    ->minValue(0)
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('año')
                    ->state(fn(Periodo $record) => $record->fecha->format('Y')),
                Tables\Columns\TextColumn::make('mes')
                    ->state(fn(Periodo $record) => ucwords($record->fecha->translatedFormat('F'))),
                Tables\Columns\TextColumn::make('horas_trabajadas')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateRecordDataUsing(function (array $data): array {
                        $fecha = Carbon::parse($data['fecha']);

                        $data['año'] = $fecha->format('Y'); // Extraer el año
                        $data['mes'] = $fecha->format('m'); // Extraer el mes en formato numérico
                        return $data;
                    })
                    ->using(function (Tables\Actions\EditAction $action, Periodo $record, array $data): Periodo {
                        $data['fecha'] = "{$data['año']}-{$data['mes']}-01";

                        // Validar unicidad al guardar
                        if (Periodo::where('fecha', $data['fecha'])->where('id', '!=', $record->id)->exists()) {
                            if (Periodo::where('fecha', $data['fecha'])->exists()) {
                                Notification::make()
                                    ->title('El mes seleccionado ya ha sido registrado para el periodo' . $data['año'])
                                    ->danger()
                                    ->send();
                                $action->halt();
                            }
                        }
                        $record->update($data);
                        return $record;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePeriodo::route('/'),
        ];
    }
}
