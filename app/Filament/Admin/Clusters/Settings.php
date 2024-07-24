<?php

namespace App\Filament\Admin\Clusters;

use Filament\Clusters\Cluster;

class Settings extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected ?string $heading = 'Ajustes';
    protected static ?string $breadcrumb = 'Ajustes';
    protected static ?string $title = 'Ajustes';
    // protected ?string $subheading = 'En esta sección podra registrar las notas';
    public static function getNavigationLabel(): string
    {
        return __("menu.nav_group.settings");
    }
}
