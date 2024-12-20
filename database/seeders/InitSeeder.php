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
        $unidades_organicas = base_path('database/sql/unidades_organicas.sql');
        $cargos = base_path('database/sql/cargos.sql');
        $tipo_planillas = base_path('database/sql/tipo_planillas.sql');
        $condiciones = base_path('database/sql/condiciones.sql');
        $desplazamientos = base_path('database/sql/desplazamientos.sql');
        $regimen_laborales = base_path('database/sql/regimen_laborales.sql');
        $funciones = base_path('database/sql/funciones.sql');
        $empleados = base_path('database/sql/empleados.sql');
        $capacitaciones = base_path('database/sql/capacitaciones.sql');
        $patologias = base_path('database/sql/patologias.sql');
        $laboratorio = base_path('database/sql/laboratorio.sql');
        $vacunas = base_path('database/sql/vacunas.sql');
        // NOTIFICACIONES
        $scat = base_path('database/sql/SCAT.sql');
        $anexoUno = base_path('database/sql/anexo_uno.sql');
        $preguntas = base_path('database/sql/declaracion_preguntas.sql');

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
        if (file_exists($unidades_organicas)) {
            $sql = file_get_contents($unidades_organicas);
            \DB::unprepared($sql);
        }
        if (file_exists($cargos)) {
            $sql = file_get_contents($cargos);
            \DB::unprepared($sql);
        }
        if (file_exists($tipo_planillas)) {
            $sql = file_get_contents($tipo_planillas);
            \DB::unprepared($sql);
        }
        if (file_exists($condiciones)) {
            $sql = file_get_contents($condiciones);
            \DB::unprepared($sql);
        }
        if (file_exists($desplazamientos)) {
            $sql = file_get_contents($desplazamientos);
            \DB::unprepared($sql);
        }
        if (file_exists($regimen_laborales)) {
            $sql = file_get_contents($regimen_laborales);
            \DB::unprepared($sql);
        }
        if (file_exists($funciones)) {
            $sql = file_get_contents($funciones);
            \DB::unprepared($sql);
        }
        if (file_exists($anexoUno)) {
            $sql = file_get_contents($anexoUno);
            \DB::unprepared($sql);
        }
        if (file_exists($empleados)) {
            $sql = file_get_contents($empleados);
            \DB::unprepared($sql);
        }
        if (file_exists($scat)) {
            $sql = file_get_contents($scat);
            \DB::unprepared($sql);
        }
        if (file_exists($capacitaciones)) {
            $sql = file_get_contents($capacitaciones);
            \DB::unprepared($sql);
        }
        if (file_exists($patologias)) {
            $sql = file_get_contents($patologias);
            \DB::unprepared($sql);
        }
        if (file_exists($laboratorio)) {
            $sql = file_get_contents($laboratorio);
            \DB::unprepared($sql);
        }
        if (file_exists($vacunas)) {
            $sql = file_get_contents($vacunas);
            \DB::unprepared($sql);
        }
        if (file_exists($preguntas)) {
            $sql = file_get_contents($preguntas);
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
            'parent_id' => null,
            'distrito_id' => '140108'
        ];

        \DB::table('establecimientos')->insert($data);
    }
}
