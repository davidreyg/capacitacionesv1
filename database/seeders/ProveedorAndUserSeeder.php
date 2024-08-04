<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProveedorAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Obtener todos los establecimientos con sus nombres y tipos
        $password = \Hash::make('password');
        Proveedor::get()->each(function (Proveedor $proveedor) use ($password) {
            $user = $proveedor->user()->create([
                // 'id' => (string) Str::uuid(),
                'username' => $proveedor->numero_documento,
                'nombre_completo' => $proveedor->razon_social,
                'cargo' => "Proveedor",
                'email' => $proveedor->correo,
                'email_verified_at' => now(),
                'password' => $password, // o usa bcrypt('password')
            ]);
            $user->assignRole(config('app-roles.roles.proveedor'));
        });
    }
}
