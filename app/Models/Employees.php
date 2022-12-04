<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = ['emp_id', 'name', 'dept_id', 'section_id', 'job', 'tel', 'extn', 'active'];
}
