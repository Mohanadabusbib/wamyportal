<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Models\Corona;
use App\Models\Department;
use App\Models\Section;
use App\Models\Visitor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $visitor;
    public function __construct(Visitor $visitor)
    {
        $this->visitor = $visitor;
    }
    public function index()
    {
        $departments = Department::get()->pluck('name', 'id');
        return view('visitors.index',compact('departments'));
    }

    public function myformAjax($id)
    {
        /* $sections = DB::table("sections")->where("deptid", $id)->lists("name", "id"); */
        $sections = Section::where("deptid", $id)->pluck('name', 'id');
        return json_encode($sections);
    }
    public function approval (){
        $day = Carbon::now()->format('yy-m-d');
        $visitors = $this->visitor::with(['user', 'department', 'section'])->latest()->get(); /* where([['approved', '=', 1]])-> */

        return view('visitors.approval', compact('visitors'));
        /* return dd($visitors); */
    }
    public function display($id){
        $day = Carbon::now()->format('yy-m-d');
        if ($id == 1) {
            $corona = Corona::with('user')->where([
                ['created','=', $day],
                ['approved','=', 1],
                ['mainapproved','=', 0]
            ])->get();
            return view('security.index',compact('corona','id'))->with('error');
        } elseif ($id == 2) {
            $visitors = $this->visitor::with(['user', 'department', 'section'])->where([
                ['approved','=',1]
            ])->latest()->get();
            return view('security.index',compact('visitors','id'))->with('error');
        }




        /* return $corona; */
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
        $day = Carbon::now()->format('yy-m-d');
        $this->visitor->create($request->all() + ['created' => $day, 'user_id' => Auth::user()->id]);
        return redirect()->back()->with('success','تم إضافة طلب');

    }
    public function updateVisitor (Request $request,$id){
        /* $this->visitor->find($id)->update($request->all()+['mainapproved' => 1]);
        return back(); */
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        /* $this->visitor->find($id)->update($request->all()+['mainapproved' => 1]);
        return back(); */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->visitor->find($id)->update($request->all());
        $visitor = $this->visitor->find($id);
        /* $data = $this->visitor->find($id); */
        /* $this->visitor->find($visitor)->update($request->all()); */
        /* $order = $this->visitor::with('user')->find($visitor);
        $data = array(
            'name' => $order->user->name,
            'approved' => $order->approved,
            'vname' => $order->vname,
            'vdate' => $order->vdate
        );
        Mail::to($order->user->email)->send(new SendMail($data));
        $order = $this->visitor::with('user')->find($visitor); */
        $data = [
            'vname' => $visitor->vname,
            'vdate' =>$visitor->vdate,
            'approved' => $request->approved,
        ];
        event(new NewNotification($data));
        return back() ;  /* ->with('success', trans('alerts.updateord')); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        //
    }
}
