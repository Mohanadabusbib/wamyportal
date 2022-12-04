<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name','active','address','created_at','updated_at','deleted_at','description','latitude','longitude',
    ];
}
