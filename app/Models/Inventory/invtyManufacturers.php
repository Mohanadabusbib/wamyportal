<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class invtyManufacturers extends Model
{
    protected $fillable = ['name', 'userEntry'];

    protected $table = "invtymanufacturers";
}
