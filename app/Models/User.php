<?php

namespace App\Models;

use App\Traits\CheckUserType;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasName, HasMedia
{
    use InteractsWithMedia;
    use HasUuids, HasRoles;
    use HasApiTokens, HasFactory, Notifiable;
    use CheckUserType;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'nombre_completo',
        'cargo',
        'password',
        'empleado_id',
        'proveedor_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFilamentName(): string
    {
        return $this->nombre_completo;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->isSuperAdmin() || $this->hasPermissionTo('panel_admin');
        } else if ($panel->getId() === 'establecimiento') {
            return $this->empleado !== null;
        } else if ($panel->getId() === 'proveedor') {
            return $this->empleado === null && $this->proveedor !== null;
        } else {
            return false;
        }
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->getMedia('avatars')?->first()?->getUrl() ?? $this->getMedia('avatars')?->first()?->getUrl('thumb') ?? null;
    }

    // Define an accessor for the 'name' attribute
    public function getNameAttribute()
    {
        return "{$this->nombre_completo}";
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole(config('filament-shield.super_admin.name'));
    }

    public function registerMediaConversions(Media|null $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    // RELACIONES
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Esto nunca deberia pasar!
        static::saving(function ($model) {
            if ((is_null($model->empleado_id) && is_null($model->proveedor_id)) || (!is_null($model->empleado_id) && !is_null($model->proveedor_id))) {
                throw new \Exception('Un usuario debe ser o proveedor o empleado, pero no ambos ni ninguno.');
            }
        });
    }

    function getUser()
    {
        return $this;
    }

}
