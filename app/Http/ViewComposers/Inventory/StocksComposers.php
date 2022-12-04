<?php

namespace App\Http\ViewComposers\Inventory;

use App\Models\Inventory\invtyStock;
use Illuminate\View\View;

class StocksComposers
{
    protected $stocks;
    public function __construct(invtyStock $stocks)
    {
        $this->stocks = $stocks;
    }

    public function compose(View $view)
    {
        return $view->with('stocks',$this->stocks->all());
    }
}