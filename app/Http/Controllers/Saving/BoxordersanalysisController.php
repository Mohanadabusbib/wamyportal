<?php

namespace App\Http\Controllers\Saving;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Alert;
use App\Models\Saving\approvedGuarantees;
use App\Models\Saving\boxorders;
use App\Models\Saving\boxordersanalysis;
use App\Models\Saving\boxordersponsors;
use App\Models\Saving\BoxOrdersType;
use App\Models\TransferData\empbox;
use App\Models\TransferData\empdata;
use Dotenv\Result\Success;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;
use RealRashid\SweetAlert\Storage\AlertSessionStore;
use Carbon\Carbon;

class BoxordersanalysisController extends Controller
{
    protected $boxorders;
    protected $boxOrdersType;
    protected $boxordersanalysis;
    protected $boxordersponsors;
    protected $approvedGuarantees;

    public function __construct(boxordersanalysis $boxordersanalysis ,boxorders $boxorders,boxordersponsors $boxordersponsors ,
         BoxOrdersType $boxOrdersType,approvedGuarantees $approvedGuarantees)
    {
        $this->boxorders = $boxorders;
        $this->boxOrdersType = $boxOrdersType;
        $this->boxordersanalysis = $boxordersanalysis;
        $this->boxordersponsors = $boxordersponsors;
        $this->approvedGuarantees = $approvedGuarantees;
    }

    public function index()
    {
        $orders = DB::select('SELECT b.id,b.empid,b.name as emp,b.purchasingValue,t.name,a.status AS fStatus,b.fStatus AS bStatus, a.lastUser,
        CASE WHEN b.qtyDevice >= 1 THEN b.descDevice WHEN b.qtyFurniture >= 1 THEN b.descFurniture WHEN b.qtyCar >= 1 THEN b.descCar END AS "Order",
         a.salaryEmp,a.deductionsHr,a.deductionsBox, s.sponsor ,b.status,b.created_at FROM boxorders b INNER JOIN boxorderstypes t ON t.id=b.reqType
          INNER JOIN boxordersanalyses a ON b.id = a.boxorders_id LEFT JOIN boxordersponsors s ON b.id = s.boxorders_id ORDER BY b.id DESC');

        return view('savings.requests.financial',compact('orders'));
    }

    public function show($id)
    {
         
       try {
        if(Auth()->user()->empid == 11829 || Auth()->user()->empid == 11402)
        {
            /* $empid = 11964; */
            
            /* صاحب الطلب */
            $empid = $this->boxorders::where('id',$id)->pluck('empid')->first(); /* رقم صاحب الطلب */
            /* $empid = 11964; */
            $empName = $this->boxorders::where('id',$id)->pluck('name')->first(); /* إسم صاحب الطلب */       
            $reqType = DB::select('select t.name as name FROM boxorders b, boxorderstypes t WHERE b.reqType = t.id AND b.id =  ?',[$id]);
            
            $endServiceEmpAry = empbox::where([['emp_no',$empid],['type','endService']])->get(); /*  نهاية الخدمة للموظف */
            $data = empdata::where('emp_no',$empid)->get();

            $orderSalary = $data[0]['total_sal']; /* الراتب */
            $purchasingValue = $this->boxorders::where('id',$id)->pluck('purchasingValue')->first(); /* القيمة الشرائية للطلب */        
            $deductionsHr = $this->boxordersanalysis::where('boxorders_id',$id)->pluck('deductionsHr')->first(); /* إستقطاعات الشؤون الادارية */
            $deductionsBox = $this->boxordersanalysis::where('boxorders_id',$id)->pluck('deductionsBox')->first(); /* إستقطاعات الصندوق */
            $deductions = $deductionsHr + $deductionsBox; /* إجمالي الإستقطاعات */
            $endServiceEmp2 = $endServiceEmpAry[0]['amt'];
            
            /* return $empid; */

            foreach ($reqType as $type) {
                $typeOrder = $type->name;
            }

            /* return $reqType; */
            $sprAva = $this->boxordersanalysis::where([['sprId','!=','NULL'],['boxorders_id',$id]])->get();

            /* $sprAva = $this->boxordersponsors::where('boxorders_id',$id)->get();            */
            /* return $sprAva; */
            if (count($sprAva) == 1) {
                $found = DB::select('SELECT b.id, b.empid,a.salaryEmp,a.purchasingValue, b.name, `reqType`,t.name,a.deductionsBox,a.endServiceEmp,
                a.balanceboxEmp,(a.endServiceEmp + a.balanceboxEmp)tot, a.debtFurnitureEmp,a.debtCarEmp,a.anothSponosrEmp,(a.debtFurnitureEmp + a.debtCarEmp + a.anothSponosrEmp)tot2, 
                a.sprId,u.name,a.salarySpr,a.endServiceSpr,a.balanceboxSpr,(a.endServiceSpr + a.balanceboxSpr)tot3,a.debtFurnitureSpr,a.debtCarSpr,a.anothSponosrSpr,
                (a.debtFurnitureSpr + a.debtCarSpr + a.anothSponosrSpr) tot4 
                ,a.evaluation,a.reson
                FROM boxorders b INNER JOIN boxordersanalyses a ON b.id=a.boxorders_id 
                INNER JOIN boxorderstypes t ON b.reqType = t.id INNER JOIN users u ON u.empid = a.sprId
                WHERE b.id =?', [$id]);
            } else {
                $found = DB::select('SELECT b.id, b.empid,a.salaryEmp,a.purchasingValue, b.name, `reqType`,t.name,a.deductionsBox,a.endServiceEmp,
                a.balanceboxEmp,(a.endServiceEmp + a.balanceboxEmp)tot, a.debtFurnitureEmp,a.debtCarEmp,a.anothSponosrEmp,(a.debtFurnitureEmp + a.debtCarEmp + a.anothSponosrEmp)tot2
                ,a.evaluation,a.reson
                FROM boxorders b INNER JOIN boxordersanalyses a ON b.id=a.boxorders_id 
                INNER JOIN boxorderstypes t ON b.reqType = t.id 
                WHERE b.id =? ', [$id]);
            }
          
            foreach ($found as $value) {
                $checkEndServiceEmp =  $value->endServiceEmp;
            }
            if ($checkEndServiceEmp == null) {
                $checkEndServiceEmp = 0;
            } 
            /* return $checkEndServiceEmp; */
            $approval = DB::select('select approvedGuarantees from approved_guarantees where orderId = ?', [$id]);
            $sprId   = $this->boxordersponsors::where('boxorders_id',$id)->pluck('empid')->first(); /* رقم صاحب الطلب */
            
            if ($sprId) {
                
                $sprName = $this->boxordersponsors::where('boxorders_id',$id)->pluck('sponsor')->first(); /* رقم صاحب الطلب */
                
                $approvalSponsor = $this->boxordersponsors::where('boxorders_id',$id)->pluck('approvalSponsor')->first(); /* حالة الطلب */
                         
                $sprData =  empdata::where('emp_no',$sprId)->get();
                   
                $sprDeductionsHr = empbox::where([['emp_no',$sprId],['type','hr']])->get(); /* إستقطاعات الشؤون الادارية */
                
                $sprDeductionsBox = empbox::where([['emp_no',$sprId],['type','box']])->get(); /* إستقطاعات الصندوق */
                
                $sprSalary = $sprData[0]['total_sal']; /* الراتب */
                

                $endServiceSprAry = empbox::where([['emp_no',$sprId],['type','endService']])->get(); /*  نهاية الخدمة للكافل */
                
                /* return $sprId."~".$sprName; */
                /* return $sprId."~".$sprName;    
                return $sprDeductionsHr;   */
                /* $sprDeductionsBox2 = $sprDeductionsBox[0]['amt']; */
                
                $sprDeductionsHr = $sprDeductionsHr != NULL ? 0 :$sprDeductionsHr[0]['amt']; 

                /* return $sprDeductionsBox; */
                
                /* $sprDeductionsBox = $sprDeductionsBox[0]['amt'] != NULL ?  0 : $sprDeductionsBox[0]['amt']; */
                /* return $sprId."~".$sprName."~".$sprSalary; */
                /* $sprDeductions = $sprDeductionsHr[0]['amt'] + $sprDeductionsBox[0]['amt']; */ /* إجمالي الإستقطاعات */ 
                $sprDeductions = $sprDeductionsHr + $sprDeductionsBox[0]['amt']; /* إجمالي الإستقطاعات */ 
                
                $endServiceSpr = $endServiceSprAry[0]['amt'];
                
                return view('savings.requests.analysis',compact(['id','empid','empName','typeOrder','orderSalary','purchasingValue','deductions',
                'deductionsBox','endServiceEmp2','checkEndServiceEmp','sprId','sprName','approvalSponsor','sprSalary','sprDeductions','endServiceSpr','sprDeductionsBox','found','approval']));   
                
            } else {
                $sprId = 0;
                return view('savings.requests.analysis',compact(['id','empid','empName','typeOrder','orderSalary','purchasingValue','deductions',
                'deductionsBox','endServiceEmp2','checkEndServiceEmp','sprId','found','approval'])); 
            }
        }else{
            return 'الصفحة لا تعمل لاغراض الصيانة';
        }
       } catch (\Throwable $th) {
          return redirect()->back()->withErrors(['errors'=> $th->getMessage()]);
       }
             
            
              
    }
   public function getData($id)
   {
    try {
        $orders = DB::select('SELECT b.id,b.empid,b.name as emp,b.purchasingValue,t.name,a.status AS fStatus,a.lastUser,
        CASE WHEN b.qtyDevice >= 1 THEN b.descDevice WHEN b.qtyFurniture >= 1 THEN b.descFurniture WHEN b.qtyCar >= 1 THEN b.descCar END AS "Order",
        a.salaryEmp,a.deductionsHr,a.deductionsBox,a.endServiceEmp,a.balanceboxEmp,(a.balanceboxEmp + a.endServiceEmp) AS totalGuaranteesEmp,  
        a.debtFurnitureEmp,a.debtCarEmp,a.anothSponosrEmp, (a.debtFurnitureEmp + a.debtCarEmp + a.anothSponosrEmp)AS totalCommitmentEmp,
        (a.balanceboxEmp + a.endServiceEmp) - (a.debtFurnitureEmp + a.debtCarEmp + a.anothSponosrEmp) AS guaranteesAvailableEmp,
        s.empid as sprId, s.sponsor,s.approvalSponsor ,a.salarySpr, a.endServiceSpr, a.balanceboxSpr, a.debtFurnitureSpr, a.debtCarSpr, a.anothSponosrSpr,
        (a.balanceboxSpr + a.endServiceSpr) AS totalGuaranteesSpr,(a.debtFurnitureSpr + a.debtCarSpr + a.anothSponosrSpr)AS totalCommitmentSpr,
        (a.balanceboxEmp + a.endServiceEmp + a.balanceboxSpr + a.endServiceSpr) AS totalGuaranteesAll,
        (a.debtFurnitureEmp + a.debtCarEmp + a.anothSponosrEmp +a.debtFurnitureSpr + a.debtCarSpr + a.anothSponosrSpr) AS totalCommitmentAll,
        (a.balanceboxEmp + a.endServiceEmp + a.balanceboxSpr + a.endServiceSpr) -
        (a.debtFurnitureEmp + a.debtCarEmp + a.anothSponosrEmp +a.debtFurnitureSpr + a.debtCarSpr + a.anothSponosrSpr) AS guaranteesAvailable,
        a.reson,a.evaluation,a.lastPurchasingValue,a.salesPrice,a.monthlyInstallment,a.dateLastInstallment,b.status,b.created_at,b.updated_at
        FROM boxorders b INNER JOIN boxorderstypes t ON t.id=b.reqType and b.id = ?
        INNER JOIN boxordersanalyses a ON b.id = a.boxorders_id LEFT JOIN boxordersponsors s ON b.id = s.boxorders_id ORDER BY lastUser,b.id DESC',[$id]);
        /* return $orders; */
        /* return "Ok"; */
        $sprId   = $this->boxordersponsors::where('boxorders_id',$id)->pluck('empid')->first(); /* رقم صاحب الطلب */
        return view('savings.requests.updateAnalysis',compact('orders','sprId'));
    } catch (\Throwable $th) {
        return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
    }

   }
    public function showReport()
    {
        $orders = DB::select('SELECT b.id,b.empid,b.name as emp,b.purchasingValue,t.name,a.status AS fStatus,a.evaluation,
        CASE WHEN b.qtyDevice >= 1 THEN b.descDevice WHEN b.qtyFurniture >= 1 THEN b.descFurniture WHEN b.qtyCar >= 1 THEN b.descCar END AS "Order",
         a.reson, a.salaryEmp,a.deductionsHr,a.deductionsBox, s.sponsor ,b.status,b.created_at FROM boxorders b INNER JOIN boxorderstypes t ON t.id=b.reqType 
         AND b.deleted_at IS Null INNER JOIN boxordersanalyses a ON b.id = a.boxorders_id AND a.status != 0 LEFT JOIN boxordersponsors s ON b.id = s.boxorders_id 
         ORDER BY fStatus');
         /* if (Auth()->user()->empid == 11829) {
            
         } */
         return  view('savings.requests.repAftAnalysis',compact('orders'));
        
    }    
    
    public function store(Request $request)
    {
        if (Auth()->user()->empid == 11829 )
        {
            return $request;
        } else {
            Alert::error('خطأ', 'لم يكتمل العمل');
        }
    }

    public function update(Request $request,$id)
    {
            /* return $request->sprAvilb; */
            $approvedId = $this->boxordersanalysis::where('boxorders_id', $id)->pluck('id')->first();
            if ($request->types == 2) {
                if ($request->approvedGuarantees) {
                    foreach ($request->approvedGuarantees as $key => $value) {
                        $this->approvedGuarantees::create([
                                'approvedId' => $approvedId,
                                'orderId' => $id,
                                'approvedGuarantees' => $value        
                            ]);
                        }
                }
            } else {
                if ($request->approvedGuarantees) {
                    foreach ($request->approvedGuarantees as $key => $value) {
                        $this->approvedGuarantees::where('orderId', $id)->update([
                                'approvedId' => $approvedId,
                                'approvedGuarantees' => $value        
                            ]);
                        }
                }
            }
            if ($request->sprAvilb == 1) {
                $this->boxordersanalysis::where('boxorders_id', $id)->update([
                    'endServiceEmp' => $request->endServiceEmp,
                    'balanceboxEmp'	=> $request->balanceboxEmp,
                    'debtFurnitureEmp' => $request->debtFurnitureEmp,
                    'debtCarEmp'    => $request->debtCarEmp,
                    'anothSponosrEmp' => $request->anothSponosrEmp,
                    'sprId'	=> $request->sprId,
                    'salarySpr'	=> $request->salarySpr,
                    'endServiceSpr'	=> $request->endServiceSpr,
                    'balanceboxSpr'	=> $request->balanceboxSpr,
                    'debtFurnitureSpr'=> $request->debtFurnitureSpr,
                    'debtCarSpr'=> $request->debtCarSpr ,
                    'anothSponosrSpr'	=> $request->anothSponosrSpr,
                    'evaluation'=> $request->evaluation,
                    
                    'reson'	=> $request->reson,
                    'userEntry' => Auth()->user()->empid,
                    'status' => 1,
                ]); 
            } else if ($request->sprAvilb == 0) {
                $this->boxordersanalysis::where('boxorders_id', $id)->update([
                    'endServiceEmp' => $request->endServiceEmp,
                    'balanceboxEmp'	=> $request->balanceboxEmp,
                    'debtFurnitureEmp' => $request->debtFurnitureEmp,
                    'debtCarEmp'    => $request->debtCarEmp,
                    'anothSponosrEmp' => $request->anothSponosrEmp,
                    'sprId'	=> 0,
                    'salarySpr'	=> 0,
                    'endServiceSpr'	=> 0,
                    'balanceboxSpr'	=> 0,
                    'debtFurnitureSpr'=> 0,
                    'debtCarSpr'=> 0,
                    'anothSponosrSpr'	=> 0,
                    'evaluation'=> $request->evaluation,
                    'reson'	=> $request->reson,
                    'userEntry' => Auth()->user()->empid,
                    'status' => 1,
                ]);
            }
            if ($request->evaluation == 1) {
                $this->boxorders::where('id', $id)->update([
                    'status' => 'تم إعتماد الطلب',
                    'fstatus' => 1
                ]);
                Alert::success('تم قبول الطلب','قبول'); 
            } else if ($request->evaluation == 2) {
                $this->boxorders::where('id', $id)->update([
                    'status' => 'تم رفض الطلب',
                    'fstatus' => 2
                ]);
                Alert::success('تم رفض الطلب','رفض');
            }
            return redirect('financial');
    }

    public function contractOrder($id)
    {
        $empid = $this->boxorders::where('id',$id)->pluck('empid')->first(); /* رقم صاحب الطلب */
        $data = empdata::where('emp_no',$empid)->get(); 
        $order = $this->boxorders::where('id',$id)->first();

        $approvedGuarantees = $this->approvedGuarantees::where('orderId',$id)->first();
        
        $orderData = DB::select("SELECT reqType,t.name,
        CASE WHEN b.installmentPeriod = 1 THEN 'سنة' WHEN b.installmentPeriod = 2 THEN 'سنتان' WHEN b.installmentPeriod = 3 THEN 'ثلاث سنوات'
        WHEN b.installmentPeriod = 4 THEN 'أربع سنوات' WHEN b.installmentPeriod = 5 THEN 'خمس سنوات' END AS  period,b.purchasingValue,
        CASE WHEN a.sprId > 0 THEN u.name WHEN a.sprId = 0 THEN 'لايوجد' END AS sprName,a.endServiceEmp,a.endServiceSpr,a.balanceboxEmp,a.balanceboxSpr,
        b.descDevice,b.descFurniture,CASE WHEN b.qtyDevice = b.qtyFurniture THEN b.qtyDevice WHEN b.qtyFurniture = 0 THEN b.qtyDevice 
        WHEN b.qtyDevice = 0 THEN b.qtyFurniture END AS Qty,b.qtyCar,
        a.salesPrice,a.monthlyInstallment,a.lastPurchasingValue,
        a.debtFurnitureEmp,a.debtCarEmp,a.debtFurnitureSpr,a.debtCarSpr,
        b.created_at,b.updated_at
        from boxorders b INNER JOIN boxorderstypes t ON b.reqType = t.id
        INNER JOIN boxordersanalyses a ON b.id = a.boxorders_id
        LEFT JOIN users u ON a.sprId = u.empid WHERE  b.id=?",[$id]);
        /* return $orderData ; */
        return view('savings.requests.contractOrder',compact('data','order','approvedGuarantees','orderData','id')); 
    }

    public function updatecontractOrder(Request $request)
    {   
        if ($request->status == 'تم إعتماد الطلب') {
            $this->validate($request, [
                'lastPurchasingValue' => 'required',
                'dateFirstInstallment' => 'required',
                'dateLastInstallment' => 'required',
            ], [
                'lastPurchasingValue.required' => 'لابد من إدخال القيمة الشرائية الفعلية',
                'dateFirstInstallment.required' => 'لابد من تحديد تاريخ القسط الاول',
                'dateLastInstallment.required' => 'لابد من تحديد تاريخ القسط الأخير',
            ]);
        }
        $this->boxordersanalysis::where('boxorders_id', $request->orderID)->update([
            'lastPurchasingValue' => $request->lastPurchasingValue,
            'salesPrice' => $request->salesPrice,
            'monthlyInstallment' => $request->monthlyInstallment,
            'dateFirstInstallment' => $request->dateFirstInstallment,
            'dateLastInstallment' => $request->dateLastInstallment,
            'lastUser' => Auth()->user()->empid,
            'status' => 2,
        ]);
        $this->boxorders::where('id', $request->orderID)->update([
            'descDevice' => $request->descOrder,
            'status' => 'تم إعداد العقد',
            'fstatus' => 3
        ]);
        $orderData = DB::select("SELECT reqType,t.name,
        CASE WHEN b.installmentPeriod = 1 THEN 'سنة' WHEN b.installmentPeriod = 2 THEN 'سنتان' WHEN b.installmentPeriod = 3 THEN 'ثلاثة سنين'
        WHEN b.installmentPeriod = 4 THEN 'أربعة سنين' WHEN b.installmentPeriod = 5 THEN 'خمسة سنين' END AS  period,b.purchasingValue,
        CASE WHEN a.sprId > 0 THEN u.name WHEN a.sprId = 0 THEN 'لايوجد' END AS sprName,a.endServiceEmp,a.endServiceSpr,a.balanceboxEmp,a.balanceboxSpr,
        b.descDevice,b.descFurniture,CASE WHEN b.qtyDevice = b.qtyFurniture THEN b.qtyDevice WHEN b.qtyFurniture = 0 THEN b.qtyDevice 
        WHEN b.qtyDevice = 0 THEN b.qtyFurniture END AS Qty,
        a.salesPrice,a.monthlyInstallment,a.lastPurchasingValue,
        a.debtFurnitureEmp,a.debtCarEmp,a.debtFurnitureSpr,a.debtCarSpr,
        a.salesPrice,a.monthlyInstallment,a.dateFirstInstallment,a.dateLastInstallment,
        (endServiceEmp + balanceboxEmp) AS GuaranteesEmp,
        (endServiceSpr + balanceboxSpr) AS GuaranteesSpr,
        (debtFurnitureEmp+ debtCarEmp + anothSponosrEmp) AS CommitmentsEmp,
        (debtFurnitureSpr + debtCarSpr + anothSponosrSpr) AS CommitmentsSpr,
        b.created_at,b.updated_at
        from boxorders b INNER JOIN boxorderstypes t ON b.reqType = t.id
        INNER JOIN boxordersanalyses a ON b.id = a.boxorders_id
        LEFT JOIN users u ON a.sprId = u.empid WHERE  b.id=?",[$request->orderID]);
        $empid = $this->boxorders::where('id',$request->orderID)->pluck('empid')->first();
        $data = empdata::where('emp_no',$empid)->get();
        $id = $request->orderID;
        return view('savings.requests.fContract',compact('data','orderData','id'));
    }

    public function printcontractOrder($orderID)
    {
        $orderData = DB::select("SELECT reqType,t.name,
        CASE WHEN b.installmentPeriod = 1 THEN 'سنة' WHEN b.installmentPeriod = 2 THEN 'سنتان' WHEN b.installmentPeriod = 3 THEN 'ثلاثة سنين'
        WHEN b.installmentPeriod = 4 THEN 'أربعة سنين' WHEN b.installmentPeriod = 5 THEN 'خمسة سنين' END AS  period,b.purchasingValue,
        CASE WHEN a.sprId > 0 THEN u.name WHEN a.sprId = 0 THEN 'لايوجد' END AS sprName,a.endServiceEmp,a.endServiceSpr,a.balanceboxEmp,a.balanceboxSpr,
        b.descDevice,b.descFurniture,CASE WHEN b.qtyDevice = b.qtyFurniture THEN b.qtyDevice WHEN b.qtyFurniture = 0 THEN b.qtyDevice 
        WHEN b.qtyDevice = 0 THEN b.qtyFurniture END AS Qty,
        a.salesPrice,a.monthlyInstallment,a.lastPurchasingValue,
        a.debtFurnitureEmp,a.debtCarEmp,a.debtFurnitureSpr,a.debtCarSpr,
        a.salesPrice,a.monthlyInstallment,a.dateFirstInstallment,a.dateLastInstallment,
        (endServiceEmp + balanceboxEmp) AS GuaranteesEmp,
        (endServiceSpr + balanceboxSpr) AS GuaranteesSpr,
        (debtFurnitureEmp+ debtCarEmp + anothSponosrEmp) AS CommitmentsEmp,
        (debtFurnitureSpr + debtCarSpr + anothSponosrSpr) AS CommitmentsSpr,
        b.created_at,b.updated_at
        from boxorders b INNER JOIN boxorderstypes t ON b.reqType = t.id
        INNER JOIN boxordersanalyses a ON b.id = a.boxorders_id
        LEFT JOIN users u ON a.sprId = u.empid WHERE  b.id=?",[$orderID]);
        $empid = $this->boxorders::where('id',$orderID)->pluck('empid')->first();
        $data = empdata::where('emp_no',$empid)->get();
        $id = $orderID;
        return view('savings.requests.fContract',compact('data','orderData','id'));
    }
    public function refusalOrder(Request $request,$id)
    {
        return $request;
    }
}
