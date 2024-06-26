<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \DB::table('establecimientos')->pluck('id')->each(function ($establecimientoId) {
            Empleado::factory()->count(20)->create(['establecimiento_id' => $establecimientoId]);
        });
    }
}
