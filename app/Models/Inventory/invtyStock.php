<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class invtyStock extends Model
{
    protected $table = "invtystocks";

    protected $fillable = ['StockId', 'StockNameAr', 'StockNameEn', 'StockTyp','userEntry'];
}
