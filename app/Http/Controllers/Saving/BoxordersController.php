<?php

namespace App\Http\Controllers\Saving;

use App\Models\Saving\boxorders;
use App\Models\Saving\BoxOrdersType;
use App\Models\Saving\Savings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
/* use Alert; */
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Models\Saving\boxordersanalysis;
use App\Models\Saving\boxordersponsors;
use App\Models\TransferData\empbox;
use App\Models\TransferData\empdata;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BoxordersController extends Controller
{
    protected $boxorders;
    protected $savings;
    protected $boxOrdersType;
    protected $boxordersanalysis;
    protected $boxordersponsors;

    public function __construct(boxorders $boxorders, Savings $savings,BoxOrdersType $boxOrdersType, boxordersanalysis $boxordersanalysis,boxordersponsors $boxordersponsors)
    {
        $this->boxorders = $boxorders;
        $this->savings = $savings;
        $this->boxOrdersType = $boxOrdersType;
        $this->boxordersanalysis = $boxordersanalysis;
        $this->boxordersponsors = $boxordersponsors;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function errorpage($er)
    {
        return view('alerts.errorsPages',compact('er'));
    }
    public function index()
    {
        /* fstatus =
                0 => جديد   =>  Update
                1 => تم إعتماد الطلب   => No Entry
                2 => تم رفض الطلب   => New
                3 => طباعة العقد - إغلاق الطلب   => New
            */ 
            /* if ($empid == 11829) { */

        try {
            $empid = Auth()->user()->empid; 
            /* if ($empid === 11829)
            {
                $empid = 11099;
            } */
            $savings = $this->savings::where('empid','!=',$empid)->ORDERBY('empid')->get();
            $signature = $this->savings::where('empid',$empid)->pluck('signature');
            $boxorderstype =  DB::select('SELECT id,name FROM boxorderstypes');  
            
            $data = empdata::where('emp_no',$empid)->get();
            $hr = empbox::where([['emp_no',$empid],['type','hr']])->get();
            $box = empbox::where([['emp_no',$empid],['type','box']])->get();
            
            
            $id = $this->boxorders::where('empid', $empid)->pluck('id')->last();    
            $oldBox = $this->boxorders::where('empid',$empid)->pluck('fstatus')->last();
            $deleted_at = $this->boxorders::where('empid',$empid)->pluck('deleted_at');
            /* if ($empid === 11090)
            {
                return $oldBox; 
            } */
            if (count($box) == 0) {
                $month = Carbon::now()->locale("ar_SA")->translatedFormat("F");
                $er = 'الرجاء مراجعة شؤون الموظفين لعمل إحتساب لراتب شهر  '.$month;
                return redirect()->route('errorpage',$er);
                /* return "Test"; */
            }
            if (is_null($oldBox)) {
                $id = 0;
                return view('savings.requests.index', compact('id','oldBox','data','savings','signature','boxorderstype','hr','box','deleted_at'));
            }elseif ($oldBox >= 0){
                return view('savings.requests.index', compact('id','oldBox','data','savings','signature','boxorderstype','hr','box','deleted_at'));        
            }
        } 
        catch (\Throwable $th) {
            return redirect()->back()->withErrors(['erorr' => $th->getMessage()]);
        }
        
        /* if ( Auth()->user()->empid == 11829) {
            
        } else {
            return 'الشاشة مغلقه للصيانة';
        }   */   
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        return "Point";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->finalRate > 60) {
            Alert::error('خطأ','إجمالي نسبة الاستقطاع من الراتب إعلي من الحد المسموح به يجب تخفيض القيمة الشرائية ');
            return back();
        }else {
            
            if (!empty($request->descDevice)){$descDevice = $request->descDevice;$qtyDevice = $request->qtyDevice;} else{$descDevice = "لايوجد";$qtyDevice = 0;}
            if (!empty($request->descFurniture)){$descFurniture = $request->descFurniture;$qtyFurniture = $request->qtyFurniture;} else{$descFurniture = "لايوجد";$qtyFurniture = 0;}
            if (!empty($request->descCar)){$descCar = $request->descCar;$qtyCar = $request->qtyCar;} else{$descCar = "لايوجد";$qtyCar = 0;}
            $day = Carbon::now()->format('Y-m-d h:m:s');

            if ($request->hasFile('signature')) {
                $signaturefile = time() . '-' . $request->signature->getClientOriginalName();
                $request->signature->storeAs('Signature', $signaturefile, 'public');
            }else{
                $signaturefile = $this->savings::where('empid',$request->empid)->pluck('signature')->first();
            }
            $this->savings::where('empid', $request->empid)->update([
                'signature' => $signaturefile,
            ]);
                        
            $boxorders = new BoxOrders();
            $boxorders->empid = $request->empid;
            $boxorders->name = $request->name ;
            $boxorders->reqType = $request->reqType ;
            $boxorders->installmentPeriod = $request->installmentPeriod ;
            $boxorders->rate = $request->finalRate;
            $boxorders->purchasingValue = $request->purchasingValue;
            $boxorders->descDevice = $descDevice ;
            $boxorders->qtyDevice = $qtyDevice;
            $boxorders->descFurniture = $descFurniture;
            $boxorders->qtyFurniture = $qtyFurniture;
            $boxorders->descCar = $descCar;
            $boxorders->qtyCar = $qtyCar;
            $boxorders->fstatus = 0;
            $boxorders->signature = $signaturefile;
            $boxorders->created_at = $day;
            $boxorders->save();
            
            $boxorders_id = $boxorders->id;
            Alert::success('حفظ البيانات', 'تم حفظ بيانات الطلب رقم  '.$boxorders_id.' بنجاح');
            $sponsor = $request->sponsor != 0 ? $request->sponsor : 0;
            boxordersanalysis::create([
                'boxorders_id' =>$boxorders_id,
                'salaryEmp' => $request->salary,
                'deductionsHr'=> $request->deductionsHr,
                'deductionsBox' => $request->deductionsBox,
                'purchasingValue' => $request->purchasingValue,
                'sprId' => $sponsor,
                'created_at' => $day
            ]);


            if ($request->sponsor != 0) 
            {
                $sponsorName = User::where('empid',$request->sponsor)->pluck('name')->first();

                boxordersponsors::create([
                    'boxorders_id' =>$boxorders_id,
                    'empid' => $request->sponsor,
                    'sponsor' => $sponsorName,
                    'created_at' => $day
                ]);
            }
            Alert::success('حفظ البيانات', 'تم حفظ البيانات بنجاح الطلب' );
            return redirect('home');
        }
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Saving\boxorders  $boxorders
     * @return \Illuminate\Http\Response
     */
    public function show(boxorders $boxorders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saving\boxorders  $boxorders
     * @return \Illuminate\Http\Response
     */
    public function edit(boxorders $boxorders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Saving\boxorders  $boxorders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /* $empid = Auth()->user()->empid; */

        if ($request->finalRate > 60) {
            Alert::error('خطأ','إجمالي نسبة الاستقطاع من الراتب إعلي من الحد المسموح به يجب تخفيض القيمة الشرائية ');
            return back();
         }else {
            
            if (!empty($request->descDevice)){$descDevice = $request->descDevice;$qtyDevice = $request->qtyDevice;} else{$descDevice = "لايوجد";$qtyDevice = 0;}
            if (!empty($request->descFurniture)){$descFurniture = $request->descFurniture;$qtyFurniture = $request->qtyFurniture;} else{$descFurniture = "لايوجد";$qtyFurniture = 0;}
            if (!empty($request->descCar)){$descCar = $request->descCar;$qtyCar = $request->qtyCar;} else{$descCar = "لايوجد";$qtyCar = 0;}
            $day = Carbon::now()->format('Y-m-d h:m:s');

            if ($request->hasFile('signature')) {
                $signaturefile = time() . '-' . $request->signature->getClientOriginalName();
                $request->signature->storeAs('Signature', $signaturefile, 'public');
            }else{
                $signaturefile = $this->savings::where('empid',$request->empid)->pluck('signature')->first();
            }
            $this->savings::where('empid', $request->empid)->update([
                'signature' => $signaturefile,
            ]);
                        
                    
            boxorders::where('id',$request->orderId)->update([
                'empid' => $request->empid,
                'name' => $request->name ,
                'reqType' => $request->reqType ,
                'installmentPeriod' => $request->installmentPeriod ,
                'rate' => $request->finalRate,
                'purchasingValue' => $request->purchasingValue,
                'descDevice' => $descDevice ,
                'qtyDevice' => $qtyDevice,
                'descFurniture' => $descFurniture,
                'qtyFurniture' => $qtyFurniture,
                'descCar' => $descCar,
                'qtyCar' => $qtyCar,
                'signature' => $signaturefile,
                'updated_at' => $day,
            ]);
            
            Alert::success('تعديل البيانات', 'تم تعديل بيانات الطلب رقم  '.$request->orderId.' بنجاح');

            boxordersanalysis::where('boxorders_id',$request->orderId)->update([
                'salaryEmp' => $request->salary,
                'deductionsHr'=> $request->deductionsHr,
                'deductionsBox' => $request->deductionsBox,
                'purchasingValue' => $request->purchasingValue,
                'updated_at' => $day
            ]);

            if ($request->sponsor != 0) 
            {
                $sponsorName = User::where('empid',$request->sponsor)->pluck('name')->first();
                $spr = boxordersponsors::where('boxorders_id',$request->orderId)->get();
                if($spr){
                    boxordersponsors::where('boxorders_id',$request->orderId)->update([
                        'empid' => $request->sponsor,
                        'sponsor' => $sponsorName,
                        'updated_at' => $day
                    ]);
                }else{
                    boxordersponsors::create([
                        'boxorders_id' => $request->orderId,
                        'empid' => $request->sponsor,
                        'sponsor' => $sponsorName,
                        'updated_at' => $day
                    ]);
                }
                
            }else{
                $spr = boxordersponsors::where('boxorders_id',$request->orderId)->get();
                if ($spr) {
                    boxordersponsors::where('boxorders_id',$request->orderId)->delete();
                }
            }
            Alert::success('حفظ البيانات', 'تم حفظ البيانات بنجاح الطلب' );
            return redirect('home');
         }
       /*  if (Auth()->user()->empid == 11829) {
            
        } else {
            return $request;        
        } */
        
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saving\boxorders  $boxorders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $day = Carbon::now();
        $this->boxorders::where('id',$request->id)->update([
            'deleted_at' => $day,
            'fstatus' => 3
        ]);
        return redirect()->back();

    }
}
