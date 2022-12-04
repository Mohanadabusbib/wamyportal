<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corona extends Model
{
    protected $fillable = ['user_id','empid','mixtures','fever','cough','breathing','approved','mainapproved','created'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

