<?php

namespace App\Models\Saving;

use Illuminate\Database\Eloquent\Model;

class boxorders extends Model
{
    protected $fillable = ['empid', 'name', 'reqType', 'installmentPeriod', 'purchasingValue','rate', 'descDevice', 'qtyDevice', 'descFurniture',
                'qtyFurniture', 'descCar', 'qtyCar', 'signature', 'status','fstatus','created_at'];
    public function OrdersType()
    {
        return $this->belongsTo('App\Models\Saving\BoxOrdersType');
    }
    public function Analysiss()
    {
        return $this->hasMany('App\Models\Saving\boxordersanalysis');
    }
    public function Sponsors()
    {
        return $this->hasMany('App\Models\Saving\boxordersponsors');
    }

    public function guarantees()
    {
        return $this->hasMany('App\Models\Saving\approvedGuarantees');
    }
}
