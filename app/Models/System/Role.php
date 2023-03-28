<?php

namespace App\Models\System;

use App\Models\Base\BaseModel;

class Role extends BaseModel
{
    protected $guarded = ['id'];

    protected static $logName = 'Role';

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }
}
