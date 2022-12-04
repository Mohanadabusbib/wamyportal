<?php

namespace App\Http\ViewComposers;

use App\Models\Department;
use Illuminate\View\View;

class DepartmentComposers
{
    protected $departments;

    public function __construct()
    {
        $this->departments = Department::get();
    }

    public function compose(View $view)
    {
        return $view->with('departments', $this->departments);
    }
}
