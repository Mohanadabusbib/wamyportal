<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class invtyHardware extends Model
{
    protected $table = "invtyhardware";
    protected $fillable = ['name', 'userEntry'];
}
