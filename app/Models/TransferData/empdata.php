<?php

namespace App\Models\TransferData;

use Illuminate\Database\Eloquent\Model;

class empdata extends Model
{
    protected $fillable = ['emp_no', 'emp_nm', 'e_mail', 'total_sal', 'hirch_nm', 'hirchy_prnt_nm',
     'start_date', 'qlfction_lst_nm', 'emp_job_nm', 'mobile_no', 'card_no', 'nat_nm'];
}
