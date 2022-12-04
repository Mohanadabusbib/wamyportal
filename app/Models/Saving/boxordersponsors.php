<?php

namespace App\Models\Saving;

use Illuminate\Database\Eloquent\Model;

class boxordersponsors extends Model
{
    protected $fillable = ['boxorders_id','empid','sponsor','approvalSponsor','signatureSponsor','created_at'];

    public function BoxOrder()
    {
        return $this->belongsTo('App\Models\Saving\boxorders');
    }
}
