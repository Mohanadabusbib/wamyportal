<?php

namespace App\Http\Controllers\TransferData;

use App\Http\Controllers\Controller;
use App\Models\TransferData\empbox;
use App\Models\TransferData\empdata;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TransferDataController extends Controller
{
    protected $empdata;
    protected $empbox;

    public function __construct(empdata $empdata,empbox $empbox)
    {
        $this->empdata = $empdata;
        $this->empbox = $empbox;
    }
    public function index()
    {
        /* $emps = Http::post("127.0.0.1:8000/api-v01/Get-EmployeesAll")->json();
        $hr   = Http::post("127.0.0.1:8000/api-v01/Get-DeductionsHrAll")->json();
        $box  = Http::post("127.0.0.1:8000/api-v01/Get-DeductionsBoxAll")->json();
        $endService  = Http::post("127.0.0.1:8000/api-v01/Get-EndServiceAll")->json();  */
        $year = Carbon::now()->format('Y');
        $month =  Carbon::now()->format('m');
        return view('TransferData.index',compact('year','month'));
    }

    public function storeEmpDate()
    {
        $emps = Http::post("127.0.0.1:8000/api-v01/Get-EmployeesAll")->json();
        for ($i=0; $i < count($emps); $i++) { 
            /* return $emps[$i]['emp_no']; */
            $empNow = $this->empdata::where('emp_no',$emps[$i]['emp_no'])->get();
            
            if(count($empNow) != 0)
            {
                $this->empdata::where('emp_no',$emps[$i]['emp_no'])->update([
                    'emp_no' => $emps[$i]['emp_no'],
                    'emp_nm' => $emps[$i]['emp_nm'],
                    'e_mail' => $emps[$i]['e_mail'],
                    'total_sal' => $emps[$i]['total_sal'],
                    'hirch_nm' => $emps[$i]['hirch_nm'],
                    'hirchy_prnt_nm' => $emps[$i]['hirchy_prnt_nm'],
                    'start_date' => $emps[$i]['start_date'],
                    'qlfction_lst_nm' => $emps[$i]['qlfction_lst_nm'],
                    'emp_job_nm' => $emps[$i]['emp_job_nm'],
                    'mobile_no' => $emps[$i]['mobile_no'],
                    'card_no' => $emps[$i]['card_no'],
                    'nat_nm' => $emps[$i]['nat_nm']
                ]);
            }else{
                $this->empdata::create([
                    'emp_no' => $emps[$i]['emp_no'],
                    'emp_nm' => $emps[$i]['emp_nm'],
                    'e_mail' => $emps[$i]['e_mail'],
                    'total_sal' => $emps[$i]['total_sal'],
                    'hirch_nm' => $emps[$i]['hirch_nm'],
                    'hirchy_prnt_nm' => $emps[$i]['hirchy_prnt_nm'],
                    'start_date' => $emps[$i]['start_date'],
                    'qlfction_lst_nm' => $emps[$i]['qlfction_lst_nm'],
                    'emp_job_nm' => $emps[$i]['emp_job_nm'],
                    'mobile_no' => $emps[$i]['mobile_no'],
                    'card_no' => $emps[$i]['card_no'],
                    'nat_nm' => $emps[$i]['nat_nm']
                ]);
                
            } 
        }
        return redirect('home');
    }

    public function storeBox()
    {
        /* $year = '2022';
        $month = '02'; */
        $year = Carbon::now()->format('Y');
        /* $month = Carbon::now()->subMonth()->format('m'); */
        $month = Carbon::now()->format('m');
        
        $hr = Http::post('127.0.0.1:8000/api-v01/Get-DeductionsHrAll/'.$year.'/'.$month)->json();
        $box  = Http::post('127.0.0.1:8000/api-v01/Get-DeductionsBoxAll/'.$year.'/'.$month)->json();
        $endService  = Http::post("127.0.0.1:8000/api-v01/Get-EndServiceAll")->json();

        /* return $box; */
        /* return count($box); */

        $this->empbox::truncate();
        for ($i=0; $i < count($hr); $i++) { 
            $hrNow = $this->empbox::where([
                ['emp_no','=',$hr[$i]['emp_no']],
                ['type','=', 'hr']])->get();
            if (count($hrNow) != 0){
                $this->empbox::where([
                    ['emp_no','=',$hr[$i]['emp_no']],
                    ['type','=', 'hr']])->update([
                    'amt' => $hr[$i]['amt']
                    /* `type`, `emp_no`, `amt` */
                ]);
            }else{
                $this->empbox::create([
                    'type' => 'hr',
                    'emp_no' => $hr[$i]['emp_no'],
                    'amt' => $hr[$i]['amt']
                    /* `type`, `emp_no`, `amt` */
                ]);
            }
        }
        for ($i=0; $i < count($endService); $i++) { 
            $endServiceNow = $this->empbox::where([
                ['emp_no','=',$endService[$i]['emp_no']],
                ['type','=', 'endService']])->get();
            if (count($endServiceNow) != 0){
                $this->empbox::where([
                    ['emp_no','=',$endService[$i]['emp_no']],
                    ['type','=', 'endService']])->update([
                    'amt' => $endService[$i]['amt']
                    /* `type`, `emp_no`, `amt` */
                ]);
            }else{
                $this->empbox::create([
                    'type' => 'endService',
                    'emp_no' => $endService[$i]['emp_no'],
                    'amt' => $endService[$i]['amt']
                    /* `type`, `emp_no`, `amt` */
                ]);
            }
        }
        for ($i=0; $i < count($box); $i++) { 
            $boxNow = $this->empbox::where([
                ['emp_no','=',$box[$i]['emp_no']],
                ['type','=', 'box']])->get();
            if (count($boxNow) != 0){
                $this->empbox::where([
                    ['emp_no','=',$box[$i]['emp_no']],
                    ['type','=', 'box']])->update([
                    'amt' => $box[$i]['amt']
                    /* `type`, `emp_no`, `amt` */
                ]);
            }else{
                $this->empbox::create([
                    'type' => 'box',
                    'emp_no' => $box[$i]['emp_no'],
                    'amt' => $box[$i]['amt']
                    /* `type`, `emp_no`, `amt` */
                ]);
            }
        }
        
        return redirect('home');
    }

    
}
