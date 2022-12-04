<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}
