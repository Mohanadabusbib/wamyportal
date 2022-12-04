<?php

namespace App\Http\Controllers\Saving;

use App\Http\Controllers\Controller;
use App\Models\Saving\BoxOrders;
use App\Models\Saving\BoxOrdersType;
use App\Models\Saving\BoxOrdersAnalysis;
use App\Models\Saving\BoxOrderSponsor;
use App\Models\Saving\Savings;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Alert;
use Illuminate\Support\Facades\DB;

class BoxOrdersController extends Controller
{
    protected $boxorders;
    protected $boxorderstype;
    protected $boxordersanalysis;
    protected $boxordersponsor;
    protected $savings;
    protected $user;


    public function __construct(BoxOrders $boxorders,BoxOrdersType $boxorderstype,BoxOrdersAnalysis $boxordersanalysis,
    BoxOrderSponsor $boxordersponsor,Savings $savings,User $user)
    {
        $this->boxorderstype = $boxorderstype;
        $this->boxorders = $boxorders;
        $this->boxordersanalysis = $boxordersanalysis;
        $this->boxordersponsor = $boxordersponsor;
        $this->savings = $savings;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empid =  Auth()->user()->empid;  /* 11547; */

        $savings = $this->savings::where('empid','!=',$empid)->ORDERBY('name')->get();
        $signature = $this->savings::where('empid',$empid)->first();
        $boxorderstype = DB::select('SELECT id,name FROM boxorderstypes'); /* $this->boxorderstype->all(); */ /* where('id','!=',3)->get();  */
        /* return $signature; */
        $data = Http::post("localhost/wamyApi/public/api-v01/Get-Employees/$empid")->json();
        $hr   = Http::post("localhost/wamyApi/public/api-v01/Get-DeductionsHr/$empid")->json();
        $box  = Http::post("localhost/wamyApi/public/api-v01/Get-DeductionsBox/$empid")->json();

        return view('savings.requests.index', compact('data','savings','signature','boxorderstype','hr','box'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('signature')) {
            $signaturefile = time() . '-' . $request->signature->getClientOriginalName();
            $request->signature->storeAs('Signature', $signaturefile, 'public');
        }else{
            $signaturefile = $this->savings::where('empid',$request->empid)->pluck('signature')->first();
        }

        /* $this->boxorders::create([
            'empid' => 11829,
            'name' => 'مهند',
            'reqType' => 1,
            'installmentPeriod' => 1,
            'purchasingValue' => 500,
            'descDevice' => "Iphone",
            'qtyDevice' => 2 ,
            'descFurniture' => null,
            'qtyFurniture' => null,
            'descCar' => null,
            'qtyCar' => null,
            'signature' => $signaturefile,
            'status' => 'جديد'
        ]); */
        /* $this->boxorders */
        if (!empty($request->descDevice)){$descDevice = $request->descDevice;$qtyDevice = $request->qtyDevice;} else{$descDevice = "لايوجد";$qtyDevice = 0;}
        if (!empty($request->descFurniture)){$descFurniture = $request->descFurniture;$qtyFurniture = $request->qtyFurniture;} else{$descFurniture = "لايوجد";$qtyFurniture = 0;}
        if (!empty($request->descCar)){$descCar = $request->descCar;$qtyCar = $request->qtyCar;} else{$descCar = "لايوجد";$qtyCar = 0;}

        /* return  */

        $this->boxorders::create([
            'empid' => $request->empid,
            'name' => $request->name,
            'reqType' => $request->reqType,
            'installmentPeriod' => $request->installmentPeriod,
            'purchasingValue' => $request->purchasingValue,
            'descDevice' => $request->descDevice ? $request->descDevice :"لايوجد" ,
            'qtyDevice' => $request->qtyDevice ? $request->qtyDevice : 0,
            'descFurniture' => $request->descFurniture? $request->descFurniture :"لايوجد" ,
            'qtyFurniture' => $request->qtyFurniture ? $request->qtyFurniture : 0 ,
            'descCar' => $request->descCar ? $request->descCar :"لايوجد" ,
            'qtyCar' => $request->qtyCar ? $request->qtyCar : 0 ,
            'signature' => $signaturefile,
            'status' => 'جديد'
        ]);
        /* BoxOrders::create([
            'empid' => $request->empid,
            'name' => $request->name,
            'reqType' => $request->reqType,
            'installmentPeriod' => $request->installmentPeriod,
            'purchasingValue' => $request->purchasingValue,
            'descDevice' => $request->descDevice,
            'qtyDevice' => $request->qtyDevice ,
            'descFurniture' => $request->descFurniture,
            'qtyFurniture' => $request->qtyFurniture,
            'descCar' => $request->descCar,
            'qtyCar' => $request->qtyCar,
            'signature' => $signaturefile,
            'status' => 'جديد'
        ]); */
        Alert::success('حفظ البيانات', 'تم حفظ بيانات الطلب بنجاح');
        return back();




        $boxorders_id = $this->boxorders::find('id')->pluck('id')->latest()->get();

        $this->boxordersanalysis::create([
            'boxorders_id' => 1,
            'salary'  => $request->salary,
            'deductionsHr' => $request->deductionsHr,
            'deductionsBox' => $request->deductionsBox
        ]);
        /* Alert::success('حفظ البيانات', 'تم حفظ بيانات الطلب بنجاح');
        return back(); */


        if ($request->sponsor != 0) {
            $sponsorName = Users::where('empid',$request->sponsor)->pluck('name')->first();
            $this->boxordersponsor::create([
                'boxorders_id' => $boxorders_id,
                'empid' => $request->sponsor,
                'sponsor' => $sponsorName,
            ]);
        }
        Alert::success('حفظ البيانات', 'تم حفظ بيانات الطلب بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BoxOrders  $boxOrders
     * @return \Illuminate\Http\Response
     */
    public function show(BoxOrders $boxOrders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BoxOrders  $boxOrders
     * @return \Illuminate\Http\Response
     */
    public function edit(BoxOrders $boxOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BoxOrders  $boxOrders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoxOrders $boxOrders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BoxOrders  $boxOrders
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoxOrders $boxOrders)
    {
        //
    }
}
