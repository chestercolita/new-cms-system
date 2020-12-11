<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function roleHasPermission($permission_name)
    {
        foreach ($this->permissions as $permission) {
            if (Str::lower($permission_name) == Str::lower($permission->name))
                return true;
        }
        return false;
    }
}
