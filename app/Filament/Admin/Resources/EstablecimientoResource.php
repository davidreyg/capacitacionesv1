<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EstablecimientoResource\Forms\EstablecimientoForm;
use App\Filament\Admin\Resources\EstablecimientoResource\Pages;
use App\Filament\Admin\Resources\EstablecimientoResource\RelationManagers;
use App\Models\Establecimiento;
use App\Models\Ubigeo\Departamento;
use App\Models\Ubigeo\Distrito;
use App\Models\Ubigeo\Provincia;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class EstablecimientoResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Establecimiento::class;
    protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $navigationIcon = 'tabler-building-community';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ...EstablecimientoForm::form()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipo'),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('codigo'),

                Tables\Columns\TextColumn::make('parent.nombre')
                    ->label('Padre'),
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
            ])->defaultSort('nombre');
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
            'index' => Pages\ListEstablecimientos::route('/'),
            'create' => Pages\CreateEstablecimiento::route('/create'),
            'edit' => Pages\EditEstablecimiento::route('/{record}/edit'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return array_merge(
            config('filament-shield.permission_prefixes.resource'),
            [
                'ver_seguimiento',
            ]
        );
    }
}
