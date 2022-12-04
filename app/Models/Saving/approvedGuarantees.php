<?php

namespace App\Models\Saving;

use Illuminate\Database\Eloquent\Model;

class approvedGuarantees extends Model
{
    protected $fillable = ['approvedId', 'orderId', 'approvedGuarantees'];

    public function order()
    {
        return $this->belongsToMany('App\Models\Saving\boxorders');
    }
}
