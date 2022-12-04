<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function sections()
    {
        return $this->hasMany('App\Models\Section');
    }
}
