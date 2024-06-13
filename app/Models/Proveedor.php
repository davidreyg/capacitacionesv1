<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'numero_documento',
        'razon_social',
        'telefono',
        'correo',
        'fecha_alta',
        'fecha_baja',
        'is_active',
        'observacion',
        'tipo_documento_id',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function tipo_documento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}
