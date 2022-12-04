<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class permissions extends Model
{
    protected $fillable = ['name','desc','type_id'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }


}
