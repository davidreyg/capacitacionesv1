<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NotificacionNac extends Pivot
{
    public $timestamps = false;
    protected $table = 'notificacion_nac';
    protected $casts = [
        'P' => 'boolean',
        'E' => 'boolean',
        'C' => 'boolean',
    ];
}
