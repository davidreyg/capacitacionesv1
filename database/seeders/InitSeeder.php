<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->sedePrincipal();
        $this->tipoDocumentos();
        $items = base_path('database/sql/items.sql');
        $tipo_capacitaciones = base_path('database/sql/tipos_capacitacion.sql');
        $ejes_tematicos = base_path('database/sql/ejes_tematicos.sql');
        $modalidades = base_path('database/sql/modalidades.sql');
        $oportunidades = base_path('database/sql/oportunidades.sql');
        $niveles = base_path('database/sql/niveles.sql');
        $costos = base_path('database/sql/costos.sql');
        $establecimientos = base_path('database/sql/establecimientos.sql');
        $proveedores = base_path('database/sql/proveedores.sql');

        if (file_exists($items)) {
            $sql = file_get_contents($items);
            \DB::unprepared($sql);
        }
        if (file_exists($tipo_capacitaciones)) {
            $sql = file_get_contents($tipo_capacitaciones);
            \DB::unprepared($sql);
        }
        if (file_exists($ejes_tematicos)) {
            $sql = file_get_contents($ejes_tematicos);
            \DB::unprepared($sql);
        }
        if (file_exists($modalidades)) {
            $sql = file_get_contents($modalidades);
            \DB::unprepared($sql);
        }
        if (file_exists($oportunidades)) {
            $sql = file_get_contents($oportunidades);
            \DB::unprepared($sql);
        }
        if (file_exists($niveles)) {
            $sql = file_get_contents($niveles);
            \DB::unprepared($sql);
        }
        if (file_exists($costos)) {
            $sql = file_get_contents($costos);
            \DB::unprepared($sql);
        }
        if (file_exists($establecimientos)) {
            $sql = file_get_contents($establecimientos);
            \DB::unprepared($sql);
        }
        if (file_exists($proveedores)) {
            $sql = file_get_contents($proveedores);
            \DB::unprepared($sql);
        }
    }

    public function tipoDocumentos()
    {
        \DB::table('tipo_documentos')->insert(['nombre' => 'DNI', 'digitos' => 8]);
        \DB::table('tipo_documentos')->insert(['nombre' => 'Carné de extranjeria', 'digitos' => 11]);
        \DB::table('tipo_documentos')->insert(['nombre' => 'RUC', 'digitos' => 14]);
    }
    public function sedePrincipal()
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
    }
}
