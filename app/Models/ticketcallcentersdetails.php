<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ticketcallcentersdetails extends Model
{
    protected $fillable = ['ticketcallcenters_id','callerid','callername','purposecal','procedure','note','transftransctn',
    'transferto','transfermessage','secondprocedure','status'];

    public function ticketcallcenter()
    {
        return $this->belongsTo('App\Models\ticketcallcenter');
    }
    /* public function ticketcallcenters()
    {
        return $this->hasMany('App\Models\ticketcallcenter');
    } */
}
