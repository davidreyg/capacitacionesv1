<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmpleadoAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Obtener todos los empleados con sus nombres y tipos
        $empleados = \DB::table('empleados as e1')
            ->join('establecimientos', 'e1.establecimiento_id', '=', 'establecimientos.id')
            ->select('e1.id', 'e1.nombres', 'e1.numero_documento', 'establecimientos.tipo as establecimiento_tipo', 'establecimientos.nombre as establecimiento_nombre')
            ->whereIn('e1.id', function ($query) {
                $query->select(\DB::raw('MIN(e2.id)'))
                    ->from('empleados as e2')
                    ->groupBy('e2.establecimiento_id');
            })
            ->get();
        $password = \Hash::make('password');
        foreach ($empleados as $empleado) {
            // Crear un empleado para el empleado
            // Crear el usuario correspondiente para el empleado
            $user = [
                // 'id' => (string) Str::uuid(),
                'username' => $empleado->numero_documento,
                'nombre_completo' => $empleado->nombres,
                'cargo' => "Empleado $empleado->establecimiento_nombre",
                'empleado_id' => $empleado->id,
                'proveedor_id' => null,
                'email' => $empleado->numero_documento . '@example.com',
                'email_verified_at' => now(),
                'password' => $password, // o usa bcrypt('password')
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Asignar rol basado en el tipo del empleado
            $role = match ($empleado->establecimiento_tipo) {
                'DIRIS' => config('app-roles.roles.diris'),
                'RIS' => config('app-roles.roles.ris'),
                'ESTABLECIMIENTO' => config('app-roles.roles.establecimiento'),
                default => null,
            };

            $savedUser = User::create($user);
            if ($role) {
                // Guardar el usuario en la base de datos y asignar el rol
                $savedUser->assignRole($role);
            }
        }
    }
}
