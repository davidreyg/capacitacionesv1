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
        $data = [
            'nombre' => 'DIRIS SEDE ADMINISTRATIVA',
            'codigo' => 99999999,
            'direccion' => 'Calle Los Pepitos S/N',
            'telefono' => 955927839,
            'ris' => 'LIMA',
            'tipo' => 'DIRIS',
            'parent_id' => null
        ];

        \DB::table('establecimientos')->insert($data);

        $establecimientos = base_path('database/sql/establecimientos.sql');
        if (file_exists($establecimientos)) {
            $sql = file_get_contents($establecimientos);
            \DB::unprepared($sql);
        }
    }
}
