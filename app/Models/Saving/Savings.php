<?php

namespace App\Models\Saving;

use Illuminate\Database\Eloquent\Model;

class Savings extends Model
{
    protected $fillable = ['empid','name','participationType','datePremium',
    'previouspremium','newpremium','contribute','salary','dateOfAppointment','signature','agree','enDate'];

    
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
    /**
     * Get the user that owns the Savings
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
}
