<?php

namespace App\Http\ViewComposers\Inventory;

use App\Models\Inventory\invtyTypes;
use Illuminate\View\View;

class InvtyTypeComposers
{
    protected $invtyTypes;

    public function __construct(invtyTypes $invtyTypes)
    {
        $this->invtyTypes = $invtyTypes;
    }

    public function compose(View $view)
    {
        return $view->with('invtyTypes', $this->invtyTypes->all());
    }
}
