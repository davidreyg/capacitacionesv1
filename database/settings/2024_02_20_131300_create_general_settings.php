<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('general.brand_name', 'Sistema de Gestion de RR.HH');
        $this->migrator->add('general.brand_logo', 'sites/logo.png');
        $this->migrator->add('general.brand_logoHeight', '3rem');
        $this->migrator->add('general.site_active', true);
        $this->migrator->add('general.site_favicon', 'sites/logo.ico');
        $this->migrator->add('general.site_theme', [
            "primary" => "rgb(19, 83, 196)",
            "secondary" => "rgb(103,181,172)",
            "gray" => "rgb(107, 114, 128)",
            "success" => "rgb(33,186,69)",
            "danger" => "rgb(193,0,21)",
            "info" => "rgb(49,204,236)",
            "warning" => "rgb(242,192,55)",
        ]);
    }
};
