<?php

namespace App\Models\TransferData;

use Illuminate\Database\Eloquent\Model;

class empbox extends Model
{
    protected $fillable = ['type', 'emp_no', 'amt'];
}
