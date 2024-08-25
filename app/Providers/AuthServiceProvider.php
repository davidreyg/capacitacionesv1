<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Laboratorio\Prueba;
use App\Policies\ActivityPolicy;
use App\Policies\ExceptionPolicy;
use App\Policies\Laboratorio\PruebaPolicy;
use BezhanSalleh\FilamentExceptions\Models\Exception;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Activity::class => ActivityPolicy::class,
        Prueba::class => PruebaPolicy::class,
        Exception::class => ExceptionPolicy::class,
        'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
