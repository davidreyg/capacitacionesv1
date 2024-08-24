<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PanelPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $super_admin = config('filament-shield.super_admin.name');
        DB::table('permissions')->insert(['name' => 'panel_admin', 'guard_name' => 'web']);
    }
}
