<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class votes2 extends Model
{
    protected $fillable = ['empid','candidatePosition','candidatePerson','persoName','approval'];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'empid');
    }
}
