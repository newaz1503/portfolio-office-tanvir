<?php

namespace App\Models;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Models\System\Role;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard  = 'admin';

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'username',
        'password',
        'role_id',
        'profile',
        'mobile',
        'address',
        'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function getProfileAttribute($value)
    {
        if (!empty($value)) {
            return url('/') . "/public/storage/" . $value;
        }
        return null;
    }
    public function setPasswordAttribute($val)
    {
        $this->attributes['password'] = Hash::make($val);
    }
}
