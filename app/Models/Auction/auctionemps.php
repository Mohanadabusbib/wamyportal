<?php

namespace App\Models\Auction;

use Illuminate\Database\Eloquent\Model;

class auctionemps extends Model
{
    protected $fillable = ['empid','name','total_sal', 'start_date', 'userEntry', 'status'];
}
