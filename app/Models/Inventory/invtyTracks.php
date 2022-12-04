<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class invtyTracks extends Model
{
    protected $fillable = ['HdwId', 'HdwBarcode', 'HdwName', 'StockIN', 'TohdwId', 'ManfId', 'HdwModel', 'HdwType', 'img', 'userEntry'];
    
    protected $table = "invtytracks";
}
