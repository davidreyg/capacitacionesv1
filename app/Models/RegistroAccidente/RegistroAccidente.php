<?php

namespace App\Models\RegistroAccidente;

use App\Enums\RegistroAccidente\CausasGrupoEnum;
use App\Models\Empleado;
use App\Models\Establecimiento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroAccidente extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function registroAccidenteCausaBasicas()
    {
        return $this->hasMany(RegistroAccidenteCausa::class)->where('grupo', CausasGrupoEnum::CAUSAS_BASICAS);
    }

    public function registroAccidenteCausaInmediatas()
    {
        return $this->hasMany(RegistroAccidenteCausa::class)->where('grupo', CausasGrupoEnum::CAUSAS_INMEDIATAS);
    }

    public function establecimientoPrincipal()
    {
        return $this->belongsTo(Establecimiento::class, 'establecimiento_principal_id');
    }

    public function establecimientoIntermediario()
    {
        return $this->belongsTo(Establecimiento::class, 'establecimiento_intermediario_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function registroAccidenteMedidas()
    {
        return $this->hasMany(RegistroAccidenteMedidas::class);
    }

    public function registroAccidenteResponsables()
    {
        return $this->hasMany(RegistroAccidenteResponsable::class);
    }
}
