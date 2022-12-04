<?php

namespace App\Http\ViewComposers\Inventory;

use App\Models\Inventory\invtyHardware;
use Illuminate\View\View;

class HardwareComposers
{
    protected $invtyHardware;

    public function __construct(invtyHardware $invtyHardware)
    {
        $this->invtyHardware = $invtyHardware;
    }
    
    public function compose(View $view)
    {
        return $view->with('invtyHardware',$this->invtyHardware->all());   
    }
}