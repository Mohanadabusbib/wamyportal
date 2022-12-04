<?php

namespace App\Http\ViewComposers;

use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VisitorsCountComposers
{
    protected $visitors;

    public function __construct()
    {
        /* $this->departments = Department::get(); */

        $this->visitors = Visitor::where(['user_id'=> Auth::user()->id,'approval'=>1])->get();
    }

    public function compose(View $view)
    {
        return $view->with('visitors', $this->visitors);
    }
}
