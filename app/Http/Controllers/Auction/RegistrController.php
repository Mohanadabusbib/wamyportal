<?php

namespace App\Http\Controllers\Auction;

use App\Http\Controllers\Controller;
use App\Models\Auction\auctionemps;
use App\Models\TransferData\empdata;
use Illuminate\Http\Request;

class RegistrController extends Controller
{
    protected $auctionemps;

    public function __construct(auctionemps $auctionemps)
    {
        /* $this->middleware('auction.prmission',['except'=>['index','store']]); */
        $this->auctionemps = $auctionemps;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empid = Auth()->user()->empid;
        /*$empid = 11910;*/
        $empAvlbl = $this->auctionemps::whereEmpid($empid)->get();
        $data = empdata::where('emp_no',$empid)->get();
        $error = "عفواً لقد قمت بالتسجيل مسبقاً";
        if (count($empAvlbl) >= 1) {
            $data = "";
            return view('auction.regForm',compact('error','data'));
        } else {
            $error = "";
            return view('auction.regForm',compact('error','data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders = $this->auctionemps::all();
        return view('auction.approval',compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->empid <> $request->userEntry) {
                return back()->with('error','عفواً الرجاءالتأكد من البيانات المدخلة');
            }else{
                $auctionemps = new auctionemps();
                $auctionemps->empid = $request->empid;
                $auctionemps->name = $request->name ;
                $auctionemps->total_sal = $request->salary;
                $auctionemps->start_date = $request->dateOfAppointment;
                $auctionemps->userEntry = $request->userEntry;
                $auctionemps->save();
                $error = "تمت عملية التسجيل بنجاح";
                $data = "";
                /* return view('auction.regForm',compact('error','data')); */
    
                /* return view('auction.report'); */
                return redirect()->route('registrAuction.show','receipt');
             
            } 
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('auction.report');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /* return $request ; */
        /* return $request; */

        $this->auctionemps::where('id',$request->id)->update([
            'status' => 1
        ]);
        return redirect()->route('registrAuction.create');
        /* return view('auction.approval');  */
        /* boxordersanalysis::where('boxorders_id',$request->orderId)->update([
            'salaryEmp' => $request->salary,
            'deductionsHr'=> $request->deductionsHr,
            'deductionsBox' => $request->deductionsBox,
            'purchasingValue' => $request->purchasingValue,
            'updated_at' => $day
        ]); */
        /* $orders = $this->auctionemps::all();
        
        return view('auction.approval',compact('orders')); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        $this->auctionemps::where('id',$request->id)->delete();
        return redirect()->route('registrAuction.create');
    }
}
