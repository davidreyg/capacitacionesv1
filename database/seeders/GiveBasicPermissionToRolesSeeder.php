<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class GiveBasicPermissionToRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guard = 'web';
        $roles = config('app-roles.roles');
        // Dar permisos a DIRIS
        $rol1 = Role::findByName(config('app-roles.roles.diris'), $guard);
        $rol1->givePermissionTo(\DB::table('permissions')->pluck('id')->toArray());
        $rol2 = Role::findByName(config('app-roles.roles.ris'), $guard);
        $rol2->givePermissionTo([
            'page_GestionarSolicitudes',

            'enroll_students_evento',
            'view_any_evento',
            'view_evento',

            'view_any_solicitud',
            'view_solicitud',
            'create_solicitud',
            'delete_solicitud',
        ]);
        $rol3 = Role::findByName(config('app-roles.roles.establecimiento'), $guard);
        $rol3->givePermissionTo([
            'enroll_students_evento',
            'view_any_evento',
            'view_evento',

            'view_any_solicitud',
            'view_solicitud',
            'create_solicitud',
            'delete_solicitud',
        ]);

    }
}
