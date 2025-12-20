<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status',
        'contact',
        'address',
        'picture'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'id', 'role_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'role_id', 'role_id');
    }

    public function userPermissions()
    {
        return $this->hasMany(UserPermission::class, 'user_id', 'id');
    }

    public function hasRolePermission($module)
    {
        
        if ($this->permissions()->where('module', $module)->first() || $this->userPermissions()->where('module', $module)->first()) {
            return true;
        }
        
        return false;
    }

    public function hasRoleCRUDPermission($module, $permission)
    {
        if ($this->permissions()->where([['module', $module], [$permission, 'on']])->first() || $this->userPermissions()->where([['module', $module], [$permission, 'on']])->first()) {
            return true;
        }
        
        return false;
    }
}
