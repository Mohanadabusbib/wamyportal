<?php

namespace App\Http\ViewComposers;

use App\Models\Role;
use Illuminate\View\View;

class DepartmentComposers
{
    protected $role;

    public function __construct()
    {
        $this->role = Role::get();
    }

    public function compose(View $view)
    {
        return $view->with('role', $this->role);
    }
}
