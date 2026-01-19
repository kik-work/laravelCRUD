<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

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
}
