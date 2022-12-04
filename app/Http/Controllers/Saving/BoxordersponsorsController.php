<?php

namespace App\Http\Controllers\Saving;

use App\Models\Saving\Savings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Alert;
use App\Models\Saving\boxordersponsors;
use App\Models\Saving\boxorders;

class BoxordersponsorsController extends Controller
{
    protected $boxordersponsors;
    protected $boxorders;

    public function __construct(boxordersponsors $boxordersponsors, boxorders $boxorders)
    {
        $this->boxordersponsors = $boxordersponsors;
        $this->boxorders = $boxorders;
    }

    public function index()
    {
        $empid =  auth()->user()->empid;
        /* if (auth()->user()->empid == 11829 ) {
            $empid = 11175;
        } */
        $orders = DB::select('SELECT b.id,b.empid,b.name as emp,b.purchasingValue,t.name, CASE WHEN b.qtyDevice = 1 THEN b.descDevice
        WHEN b.qtyFurniture = 1 THEN b.descFurniture WHEN b.qtyCar = 1 THEN b.descCar END AS "Order", status,s.sponsor,b.created_at
        FROM boxorders b,boxorderstypes t,boxordersponsors s WHERE t.id=b.reqType and s.approvalSponsor = 0 and b.id = s.boxorders_id and s.empid = ? ',[$empid]);

        $signaturefile = Savings::where('empid',$empid)->pluck('signature')->first();

        /* $orders = BoxOrders::where('empid',11829)->get();
        return gettype($orders); */

        return view('savings.requests.sponsor',compact('orders','signaturefile'));
    }

    public function update(Request $request,$id)
    {
        if ($request->hasFile('signature')) {
            $signaturefile = time() . '-' . $request->signature->getClientOriginalName();
            $request->signature->storeAs('Signature', $signaturefile, 'public');
        }else{
            $signaturefile = Savings::where('empid',$request->empid)->pluck('signature')->first();
        }

            if ($request->value == 1) {
                $status = "موافقة الكافل";
            }elseif ($request->value == 2) {
                $status = "رفض الكافل";
            }
            $day = Carbon::now()->format('Y-m-d h:m:s');

            $this->boxorders->where('id', $request->id)->update([
                'status' => $status
                ]);
            $this->boxordersponsors->where('boxorders_id', $request->id)->update([
                'approvalSponsor' => $request->value,
                'signatureSponsor' => $signaturefile,
                'created_at' => $day
                ]);
            /* DB::table('boxorders')->where('id', $request->id)->update([
                'status' => $status
                ]); */
            
            
            /* DB::table('boxordersponsors')->where('boxorders_id', $request->id)->update([
                'approvalSponsor' => $request->value,
                'signatureSponsor' => $signaturefile,
                'created_at' => $day
                ]); */
       /*  $this->boxorders::where('id',$request->id)->update([
            'sponsorid' => $request->empid,
            'sponsor' => $request->emp_name,
            'approvalSponsor' => $request->value,
            'signatureSponsor' => $signaturefile
        ]); */
        Alert::success('حفظ البيانات', 'تم حفظ بيانات الطلب بنجاح');

        return back();
        /* return $request; */
    }
}
