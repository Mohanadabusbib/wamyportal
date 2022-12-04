<?php

namespace App\Http\Controllers;

use App\Models\ticketcallcenter;
use App\Models\ticketcallcentersdetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Alert;
use Carbon\Carbon;
use App\Notifications\CallcenterTickets;
use Illuminate\Support\Facades\Notification;


class TicketcallcenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $ticket;
    protected $ticketdetails;

    public function __construct(ticketcallcenter $ticket,ticketcallcentersdetails $ticketdetails)
    {
        $this->ticket = $ticket;
        $this->ticketdetails = $ticketdetails;
    }
    public function index()
    {
    }

    public function search(){
        return view('callcenter.search');
    }
    public function searchphone(Request $req)
    {
        
        if (Str::of($req->mobile)->length() == 9) {
            $mobile = "0".$req->mobile;
            $mobile2 = $req->mobile;
            /* return redirect()->route('getBenefactor',$mobile,$mobile2); */
        }else{
            $mobile = $req->mobile;
            $mobile2 = $req->mobile;
            /* return redirect()->route('getBenefactor',$mobile,$mobile2); */
            
        }
        return redirect('benefactor/{tel}/{tel2?}', compact('mobile','mobile2'));

        
    }
    public function getBenefactor(Request $req,$tel,$tel2)
    {
        /* $tel = "0505474062"; */
        if (Str::of($tel)->length() >= 9) {
            $data = Http::post("127.0.0.1:8000/api-v01/Get-Benefactor/$tel/$tel2")->json();
            /* $data = Http::post("localhost/wamyApi/public/api-v01/Get-Benefactor/$tel/$tel2")->json(); */
            /* $data = Http::post("http://srv.wamy.org/wamyApi/public/api-v01/Get-Benefactor/$tel/$tel2")->json(); */
            
            
            return view('callcenter.index',compact('data'));
        } /* else {
            $data = Http::post("http://srv.wamy.org/wamyApi/public/api-v01/Get-Benefactor/$req->mobile")->json();
            return view('callcenter.index',compact('data'));
        } */
    }
    public function getReceipts($dnr_no)
    {
        $data = Http::post("127.0.0.1:8000/api-v01/Get-Receipts/$dnr_no")->json();
        return view('callcenter.Receipts',compact('data'));
    } 

    public function getCallerInfo($dnr_no,$dnrName,$agnt_name,$bgn_crspnd_lnm)
    {
        $users = User::all();
        /* $data = Http::post("http://127.0.0.1:8000/api-v01/Get-Caller/$dnrName")->json(); */
        /* return dd($data); */
        return view('callcenter.ticket',compact('users','dnr_no','dnrName','agnt_name','bgn_crspnd_lnm'));
        
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
        /* return $request->transftransctn; */
        $this->validate($request, [
            'callerid' => 'required',
            'callername' => 'required',
            'purposecal' => 'required',
            'procedure' => 'required',
        ], [
            'callerid.required' => 'لابد من توفر رقم المحسن',
            'callername.required' => 'لابد من توفر إسم المحسن',
            'purposecal.required' => 'لابد من إدخال الغرض من الإتصال',
            'procedure.required' => 'لابد من إدخال الإجراء',
        ]);
        
        $this->ticket::create([
            'callerid' => $request->callerid,
            'callername' => $request->callername,
            'purposecal' => $request->purposecal,
            'procedure' => $request->procedure,
            'note' => $request->note,
            'transftransctn' => $request->has('transftransctn') ? 1 : 0,
            'transferto' => $request->has('transftransctn') ? $request->transferto :' ',
            'transfermessage' => $request->transfermessage,
            'secondprocedure' => $request->secondprocedure,
            'recivecall' => auth()->user()->name,
            'status' => 1 /* 1-open 2-procssing 3-close */
        ]);
        $ticket = $this->ticket::latest()->first()->id;
        $this->ticketdetails::create([
            'ticketcallcenters_id' => $ticket,
            'callerid' => $request->callerid,
            'callername' => $request->callername,
            'purposecal' => $request->purposecal,
            'procedure' => $request->procedure,
            'note' => $request->note,
            'transftransctn' => $request->has('transftransctn') ? 1 : 0,
            'transferto' => $request->has('transftransctn') ? $request->transferto :' ',
            'transfermessage' => $request->transfermessage,
            'secondprocedure' => $request->secondprocedure,
            'status' => 1
        ]);
        if($request->has('transftransctn') == 1)
        {
            $user = User::where('empid',$request->transferto)->first();
            $ticket2 = $this->ticket::latest()->first();
            Notification::send($user, new CallcenterTickets($ticket2));
        }
        Alert::success('حفظ البيانات', 'تم حفظ البيانات بنجاح');

        return redirect()->route('callcenter.show',$request->callerid);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ticketcallcenter  $ticketcallcenter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tickets = $this->ticket->where('callerid',$id)->get();
        return view('callcenter.reporticket',compact('tickets'));
    }
    public function alltickets()
    {
        $tickets = $this->ticket->all();        
        return view('callcenter.reportAlltickets',compact('tickets'));
    }
    public function statusAjax($id)
    {
        $tickets = $this->ticket->where('status',$id)->get(); 
        return json_encode($tickets);
    }
    public function showdetails($id)
    {
        $tickets = $this->ticketdetails->where('ticketcallcenters_id',$id)->get();
        return view('callcenter.reporticketdetails',compact('tickets'));
    }

    public function incomingticket($empName)
    {
        $users = User::all();
        $tickets = $this->ticket->where('transferto',$empName)->where('status','<>',3)->get();
        return view('callcenter.incomingticket',compact('tickets','users'));
    }
    public function procticket($id){

        
        $tickets = $this->ticket->where(['id'=>$id])->get();
        $this->ticket::where(['id'=>$id])->update([
            'status'=> 2,
        ]);      
        return view('callcenter.proceticket',compact('tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ticketcallcenter  $ticketcallcenter
     * @return \Illuminate\Http\Response
     */
    public function edit(ticketcallcenter $ticketcallcenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ticketcallcenter  $ticketcallcenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $tickets = $this->ticket->where(['id'=>$id])->get();
        if ($request->has('transactionclose') === true) {
            $this->ticket::where(['id'=>$id])->update([
                'status'=> 3,
                'procedure' => $request->procedure,
            ]);
            foreach ($tickets as $value) {
                $this->ticketdetails::create([
                    'ticketcallcenters_id' => $value->id,
                    'callerid' => $value->callerid,
                    'callername' => $value->callername,
                    'purposecal' => $value->purposecal,
                    'procedure' => $request->procedure,
                    'note' => $value->note,
                    'transftransctn' => $value->transftransctn,
                    'transferto' => $value->transferto,
                    'transfermessage' => $value->transfermessage,
                    'secondprocedure' => $value->secondprocedure,
                    'status' => 3
                ]);
            }
        } else {
            $this->ticket::where(['id'=>$id])->update([
                'status'=> 2,
                'procedure' => $request->procedure,
            ]);
            foreach ($tickets as $value) {
                $this->ticketdetails::create([
                    'ticketcallcenters_id' => $value->id,
                    'callerid' => $value->callerid,
                    'callername' => $value->callername,
                    'purposecal' => $value->purposecal,
                    'procedure' => $request->procedure,
                    'note' => $value->note,
                    'transftransctn' => $value->transftransctn,
                    'transferto' => $value->transferto,
                    'transfermessage' => $value->transfermessage,
                    'secondprocedure' => $value->secondprocedure,
                    'status' => 2
                ]);
            }
        }

        Alert::success('حفظ البيانات', 'تم حفظ البيانات بنجاح');

        /* return redirect()->route('callcenter.show',$request->callerid); */
        return redirect()->route('incomingticket',auth()->user()->name);
    }
    public function updateticket(Request $request)
    {
        /* return $request->all(); */
        /* return Carbon::today(); */
        $tickets = $this->ticket->where(['id'=>$request->id])->get();
        foreach ($tickets as $value) {
            $this->ticketdetails::create([
                'ticketcallcenters_id' => $value->id,
                'callerid' => $value->callerid,
                'callername' => $value->callername,
                'purposecal' => $value->purposecal,
                'procedure' => $value->procedure,
                'note' => $value->note,
                'transftransctn' => $value->transftransctn,
                'transferto' => $request->transferto,
                'transfermessage' => $request->transfermessage,
                'secondprocedure' => $value->secondprocedure,
                'status' => 2
            ]);
        }
        $this->ticket::where(['id'=>$request->id])->update([
            'transferto' => $request->transferto,
        ]);
        Alert::success("تم التحويل","تم التحويل لـ/ $request->transferto  بنجاح");

        /* return redirect()->route('callcenter.show',$request->id); */
        return redirect()->route('incomingticket',auth()->user()->name);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ticketcallcenter  $ticketcallcenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(ticketcallcenter $ticketcallcenter)
    {
        //
    }
}
