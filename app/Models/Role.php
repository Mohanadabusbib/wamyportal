<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";

    protected $fillable = ['role'];

    public function permissions()
    {
        return $this->belongsToMany('App\Models\permissions');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

}
