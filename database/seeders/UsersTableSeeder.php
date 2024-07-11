<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Artisan;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Superadmin user
        $sid = Str::uuid();
        DB::table('users')->insert([
            'id' => $sid,
            'username' => 'superadmin',
            'nombre_completo' => 'David Rey',
            'cargo' => 'Jefe de la DIRIS',
            'email' => 'superadmin@superadmin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('superadmin'),
            'created_at' => now(),
            'updated_at' => now(),
            'establecimiento_id' => 1,
        ]);

        // Bind superadmin user to FilamentShield
        Artisan::call('shield:super-admin', ['--user' => $sid]);

        \DB::table('establecimientos')->get()->each(function ($establecimiento) {
            $user = User::factory()->count(1)->create(['establecimiento_id' => $establecimiento->id]);
            $user->each(function (User $user) use ($establecimiento) {
                switch ($establecimiento->tipo) {
                    case 'DIRIS':
                        $user->assignRole(config('app-roles.roles.diris'));
                        break;
                    case 'RIS':
                        $user->assignRole(config('app-roles.roles.ris'));
                        break;
                    case 'ESTABLECIMIENTO':
                        $user->assignRole(config('app-roles.roles.establecimiento'));
                        break;
                }
            });
        });
    }
}

