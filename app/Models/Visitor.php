<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['user_id', 'department_id', 'section_id', 'created', 'vname', 'vpurpose', 'vdate', 'approved','mainapproved'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
}
