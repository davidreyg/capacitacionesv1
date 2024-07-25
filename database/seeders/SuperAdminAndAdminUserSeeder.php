<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminAndAdminUserSeeder extends Seeder
{
    public function run()
    {

        //Crear el empleado que sera superadmin. por defecto lo asignamos al id 1 = DIRIS SEDE ADMINISTRATIVA
        $empleado = Empleado::factory()->create(['establecimiento_id' => 1]);
        $superadmin = $empleado->user()->create([
            // 'id' => $sid,
            'username' => 'superadmin',
            'nombre_completo' => 'Super Administrador',
            'cargo' => 'Super Administrador del Sistema',
            'email' => 'superadmin@superadmin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('superadmin'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $superadmin->assignRole(config('filament-shield.super_admin.name'));

        //Crear el empleado y usuario de diris. por defecto lo asignamos al id 1 = DIRIS SEDE ADMINISTRATIVA
        $empleado2 = Empleado::factory()->create(['establecimiento_id' => 1]);
        $user = $empleado2->user()->create([
            'username' => 'diris',
            'nombre_completo' => 'Jorge Perez',
            'cargo' => 'Jefe DIRIS',
            'email' => 'diris@diris.com',
            'email_verified_at' => now(),
            'password' => Hash::make('diris'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user->assignRole(config('app-roles.roles.diris'));

    }
}

