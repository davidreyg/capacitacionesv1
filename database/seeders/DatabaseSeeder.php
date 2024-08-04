<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            InitSeeder::class,
            RolesTableSeeder::class,
            SuperAdminAndAdminUserSeeder::class,
            EmpleadoAndUserSeeder::class,
            ProveedorAndUserSeeder::class,
        ]);

        Artisan::call('shield:generate --all --ignore-existing-policies');

        $this->call([
            GiveBasicPermissionToRolesSeeder::class,
        ]);
    }
}
