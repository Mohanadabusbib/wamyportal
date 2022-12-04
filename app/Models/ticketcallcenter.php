<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ticketcallcenter extends Model
{
    protected $fillable = ['callerid','callername','purposecal','procedure','note','transftransctn','transferto','transfermessage',
    'secondprocedure','recivecall','status'];

    public function ticketcallcentersdetails()
    {
        return $this->hasMany('App\Models\ticketcallcentersdetails','ticketcallcenters_id');
    }

    
}
