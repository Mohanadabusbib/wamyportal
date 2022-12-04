<?php

namespace App\Models\Saving;

use Illuminate\Database\Eloquent\Model;

class boxordersanalysis extends Model
{
    protected $fillable = ['boxorders_id', 'salaryEmp', 'deductionsHr', 'deductionsBox', 'purchasingValue', 'endServiceEmp', 'balanceboxEmp', 'typeOrder',
     'premiumBox', 'debtFurnitureEmp', 'debtCarEmp', 'anothSponosrEmp', 'sprId', 'salarySpr', 'endServiceSpr', 'balanceboxSpr', 'debtFurnitureSpr', 'debtCarSpr',
      'anothSponosrSpr', 'evaluation', 'reson','userEntry','status', 'created_at', 'updated_at'];
      
    public function BoxOrder()
    {
        return $this->belongsTo('App\Models\Saving\boxorders');
    }

    /* public function getApprovedGuaranteesAttribute($value)

    {
        return $this->attributes['approvedGuarantees'] = json_decode($value);
    } */

}
