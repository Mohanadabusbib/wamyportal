<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['typevaluation_id','empid','name','ip'];

    public function evaluation()
    {
        return $this->belongsTo('App\Models\typevaluation');
    }
}
