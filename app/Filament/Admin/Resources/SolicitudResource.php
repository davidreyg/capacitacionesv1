<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SolicitudResource\Pages;
use App\Filament\Admin\Resources\SolicitudResource\RelationManagers;
use App\Models\Capacitacion;
use App\Models\Solicitud;
use App\Models\TipoCapacitacion;
use App\States\Solicitud\Aprobado;
use App\States\Solicitud\Evaluado;
use App\States\Solicitud\Habilitado;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SolicitudResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Solicitud::class;
    protected static ?string $pluralModelLabel = 'Solicitudes';
    protected static ?string $navigationIcon = 'tabler-folder-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('establecimiento_id')
                    ->default(auth()->user()->establecimiento_id)
                    ->relationship('establecimiento', 'nombre')
                    ->required()->columnSpanFull(),
                ...static::buildCheckboxLists(),
                Hidden::make('estado'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('capacitacion.nombre')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('establecimiento.nombre')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estado')
                    ->badge()
                    ->formatStateUsing(fn(Solicitud $record): string => $record->estado->display())
                    ->color(fn(Solicitud $record): string => $record->estado->color())
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return auth()->user()->hasRole('super_admin')
            ? parent::getEloquentQuery()
            : parent::getEloquentQuery()->where('establecimiento_id', auth()->user()->establecimiento_id);
    }

    public static function buildCheckboxLists(): array
    {
        $checkBoxLists = [];
        $tipoCapacitaciones = TipoCapacitacion::get();
        foreach ($tipoCapacitaciones as $key => $tipoCapacitacion) {
            $checkBoxLists[$key] = CheckboxList::make('capacitacion_ids')
                ->label(function () use ($tipoCapacitacion) {
                    return $tipoCapacitacion->nombre;
                })
                ->options(function () use ($tipoCapacitacion) {
                    return Capacitacion::whereTipoCapacitacionId($tipoCapacitacion->id)
                        ->get()
                        ->mapWithKeys(fn(Capacitacion $capacitacion) => [$capacitacion->id => $capacitacion->nombre])
                        ->toArray();
                })
                ->required()
                ->columns(2);
        }
        return $checkBoxLists;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSolicituds::route('/'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return array_merge(config('filament-shield.permission_prefixes.resource'), ['transition']);
    }
}
