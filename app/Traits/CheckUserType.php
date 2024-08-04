<?php
namespace App\Traits;

use App\Models\User;
use Filament\Facades\Filament;

trait CheckUserType
{
    public function isEmpleado(): bool
    {
        return $this->getUser()?->empleado !== null;
    }
    public function isProveedor(): bool
    {
        return $this->getUser()?->proveedor !== null;
    }

    public function getUser(): User|null
    {
        return Filament::auth()->check() ? Filament::auth()->user() : null;
    }
}
