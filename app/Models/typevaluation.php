<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class typevaluation extends Model
{
    protected $table = "typevaluation";

    protected $fillable = ['name'];

    public function evaluations()
    {
        return $this->hasMany('App\Models\Evaluation');
    }
}
