<?php

namespace App\Http\ViewComposers\Inventory;

use App\Models\Inventory\invtyManufacturers;
use Illuminate\View\View;

class ManufacturersComposers
{
    protected $manufacturers;

    public function __construct(invtyManufacturers $manufacturers)
    {
        $this->manufacturers = $manufacturers;
    }

    public function compose(View $view)
    {
        return $view->with('manufacturers', $this->manufacturers->all());
    }
}