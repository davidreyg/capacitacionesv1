<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SeguimientoResource\Pages;
use App\Filament\Admin\Resources\SeguimientoResource\RelationManagers;
use App\Models\Establecimiento;
use App\States\Evento\Finalizado;
use App\States\Solicitud\Aprobado;
use App\States\Solicitud\Evaluado;
use App\States\Solicitud\Solicitado;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SeguimientoResource extends Resource
{
    protected static ?string $model = Establecimiento::class;
    protected static ?string $modelLabel = 'Seguimiento';
    protected static ?string $pluralModelLabel = 'Seguimiento';
    // protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $navigationIcon = 'tabler-building-community';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->withCount([
                'solicituds as solicituds_solicitadas' => fn(Builder $query) => $query->whereNotState('estado', Evaluado::class),
                'solicituds as solicituds_aprobadas' => fn(Builder $query) => $query->whereNotState('estado', [Solicitado::class, Evaluado::class]),
                'solicituds as solicituds_finalizadas' => function (Builder $query) {
                    $query->whereHas('evento', function (Builder $query) {
                        $query->whereState('estado', Finalizado::class);
                    });
                },
                'empleados as empleados_capacitados' => function (Builder $query) {
                    $query->whereHas('eventos');
                },
            ]))
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent.nombre')
                    ->label('Padre')
                    ->wrap(),
                Tables\Columns\TextColumn::make('codigo'),
                Tables\Columns\TextColumn::make('solicituds_solicitadas')->label('Cursos Solicitados')->wrapHeader()->alignCenter(),
                Tables\Columns\TextColumn::make('solicituds_aprobadas')->label('Cursos Aprobados')->wrapHeader()->alignCenter(),
                Tables\Columns\TextColumn::make('solicituds_finalizadas')->label('Cursos Finalizados')->wrapHeader()->alignCenter(),
                Tables\Columns\TextColumn::make('empleados_count')->label('Total empleados')->counts('empleados')->wrapHeader()->alignCenter(),
                Tables\Columns\TextColumn::make('empleados_capacitados')->wrapHeader()->alignCenter(),

            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    // Tables\Actions\EditAction::make(),
                    // Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeguimientos::route('/'),
        ];
    }
}
