<?php
namespace App\Traits;

use App\Models\Establecimiento;
use Illuminate\Database\Eloquent\Builder;

trait IsEstablecimientoOwnedThroughEmpleado
{
    use CheckUserType;
    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }

    public function scopeFromAuthEstablecimientoThroughEmpleado(Builder $query): void
    {
        // Verificar si es empleado
        if ($this->isEmpleado()) {
            $user = $this->getUser()->loadMissing(['empleado']);
            $query->whereHas('empleado.establecimiento', function (Builder $query) use ($user) {
                $query->where('id', '=', $user->empleado->establecimiento_id);
            });
        }
    }

}
