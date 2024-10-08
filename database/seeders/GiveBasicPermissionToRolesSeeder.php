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
            'panel_admin',
            'page_GestionarSolicitudes',

            'enroll_students_evento',
            'view_own_evento',
            'view_evento',

            'view_any_solicitud',
            'view_solicitud',
            'create_solicitud',
            'delete_solicitud',
        ]);
        $rol3 = Role::findByName(config('app-roles.roles.establecimiento'), $guard);
        $rol3->givePermissionTo([
            'enroll_students_evento',
            'view_own_evento',
            'view_evento',

            'view_any_solicitud',
            'view_solicitud',
            'create_solicitud',
            'delete_solicitud',
        ]);
        $rol4 = Role::findByName(config('app-roles.roles.proveedor'), $guard);
        $rol4->givePermissionTo([
            'enroll_students_evento',
            'view_own_evento',
            'view_evento',
            'gestionar_evaluaciones_evento',

            'view_any_sesion',
            'view_sesion',
            'subir_recursos_sesion',
        ]);
        $rol5 = Role::findByName(config('app-roles.roles.salud_ocupacional_ipress'), $guard);
        $rol5->givePermissionTo([
            'view_any_notificacion',
            'create_notificacion',
            'update_notificacion',
            'view_notificacion',
            'delete_notificacion',
        ]);
        $rol6 = Role::findByName(config('app-roles.roles.comite'), $guard);
        $rol6->givePermissionTo([
            'panel_admin',
            'ver_verificados_notificacion',
            'evaluar_scat_notificacion',
        ]);

    }
}
