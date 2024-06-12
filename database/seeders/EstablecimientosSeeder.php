<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstablecimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $establecimientos = base_path('database/sql/establecimientos.sql');
        if (file_exists($establecimientos)) {
            $sql = file_get_contents($establecimientos);
            \DB::unprepared($sql);
        }
    }
}
