<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
    ];

    public function smartphone()
    {
        return $this->hasOne(Smartphone::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(string $role): bool
    {
        return $this->roles()
            ->where('role_name', $role)
            ->exists();
    }

    public function allPermissions()
    {
        return $this->roles
            ->pluck('permissions')
            ->flatten()
            ->unique('id')
            ->values();
    }
    public function hasPermissions(string $permission): bool
    {
        return $this->allPermissions()->contains('permission_name', $permission);
    }

    public function members(){
        return $this-> hasOne(Member::class);
    }
}
