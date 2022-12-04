<?php

namespace App\Models\Saving;

use Illuminate\Database\Eloquent\Model;

class BoxOrdersType extends Model
{
    protected $table = ['boxorderstypes'];

    protected $fillable = ['name'];

    public function Orders()
    {
        return $this->hasMany('App\Models\Saving\boxorders');
    }

}
