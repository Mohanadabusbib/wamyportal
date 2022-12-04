<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\typevaluation;
use App\Models\ipconfig;

use Illuminate\Support\Facades\DB;
use Alert;

class EvaluationController extends Controller
{
    protected $evaluation;
    protected $typevaluation;
    protected $ipconfig;

    public function __construct(Evaluation $evaluation,typevaluation $typevaluation,ipconfig $ipconfig)
    {
        $this->evaluation = $evaluation;
        $this->typevaluation = $typevaluation;
        $this->ipconfig = $ipconfig;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_ip_address = $request->ip();
        /* return $user_ip_address; */

        $ipconfig = $this->ipconfig::where(['active' => 1,'ip' => $user_ip_address])->count();
        
        if($ipconfig > 0)
        {
            return view('evaluation.index');
        }else {
            Alert::error("خطأ","غير مصرح لك بزيارة هذه الصفحة"); 
            return back();
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* $evaluations = DB::select('SELECT e.name AS emp,t.name As eval,e.typevaluation_id,COUNT(typevaluation_id) AS cont 
        FROM evaluations AS e LEFT JOIN typevaluation AS t ON t.id = e.typevaluation_id GROUP BY e.name,t.name,e.typevaluation_id
        ORDER BY e.empid, typevaluation_id'); */
        $evaluations = DB::select('SELECT empid,name, COUNT(Exc) as Ex,COUNT(Good) as Gd,COUNT(Ok) as OK,COUNT(bad) as Bd,COUNT(sobad) as Sbd FROM `evaluations_rep` GROUP BY empid,name');
        $typevaluation = $this->typevaluation::get();
        return view('evaluation.report',compact('evaluations','typevaluation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $user_ip_address = $request->ip(); */
        /* Alert::success("تم قبول التقييم","نعتذر منك ونسعى دائما لتحسين خدماتنا")->del;
        ; */
        $user_ip_address = $request->ip();
        /* return $user_ip_address; */
        /* $request->all(); */
        $this->evaluation::create([
            'typevaluation_id' => $request->typevaluation_id,
            'empid' => Auth()->user()->empid,
            'name' => Auth()->user()->name,
            'ip' =>$user_ip_address,
        ]);
        switch ($request->typevaluation_id) {
            case 1:
                Alert::success("تم قبول التقييم","شكراُ لتقييمك الموظف/ ".auth()->user()->name);    
                break;
            case 2:
                Alert::success("تم قبول التقييم","نشكر لك تبرعك معنا ونسعى دائما لتحسين خدماتنا");    
                break;
            case 3:
                Alert::success("تم قبول التقييم","نعتذر منك ونسعى دائما لتحسين خدماتنا");    
                break;
            
            default:
            Alert::success("تم قبول التقييم","نعتذر منك ونسعى دائما لتحسين خدماتنا");    
                break;
        }

        /* set_time_limit(300); */
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
