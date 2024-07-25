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

        // Obtener todos los establecimientos con sus nombres y tipos
        $establecimientos = \DB::table('establecimientos')->select('id', 'nombre', 'tipo')->get();

        foreach ($establecimientos as $establecimiento) {
            // Crear un empleado para el establecimiento
            $empleados = Empleado::factory(20)->create(['establecimiento_id' => $establecimiento->id]);

            // Crear el usuario correspondiente para el empleado
            $user = [
                'id' => (string) Str::uuid(),
                'username' => Str::random(10),
                'nombre_completo' => $empleados->first()->nombres,
                'cargo' => "Empleado $establecimiento->nombre",
                'empleado_id' => $empleados->first()->id,
                'proveedor_id' => null,
                'email' => Str::random(10) . '@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('password'), // o usa bcrypt('password')
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Asignar rol basado en el tipo del establecimiento
            $role = match ($establecimiento->tipo) {
                'DIRIS' => config('app-roles.roles.diris'),
                'RIS' => config('app-roles.roles.ris'),
                'ESTABLECIMIENTO' => config('app-roles.roles.establecimiento'),
                default => null,
            };

            if ($role) {
                // Guardar el usuario en la base de datos y asignar el rol
                $savedUser = User::create($user);
                $savedUser->assignRole($role);
            }
        }
    }
}
