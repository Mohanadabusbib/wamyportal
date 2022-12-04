<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    protected $fillable = ['InvId', 'HdwBarcode', 'InvDate', 'TypeId', 'StockIN', 'StockOUT', 'Note', 'OSystems', 'userEntry'];

    protected $table = "inventories";
}
