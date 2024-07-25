<?php
namespace App\Traits;

use App\Models\Establecimiento;
use Illuminate\Database\Eloquent\Builder;

trait IsEstablecimientoOwned
{
    use CheckUserType;
    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }

    public function scopeFromAuthEstablecimiento(Builder $query): void
    {
        // Verificar si es empleado
        if ($this->isEmpleado()) {
            $user = $this->getUser()->loadMissing(['empleado']);
            $query->where('establecimiento_id', $user->empleado->establecimiento_id);
        }
    }

}
