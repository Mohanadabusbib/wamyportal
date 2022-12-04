<?php

namespace App\Http\Controllers;

use App\Models\Corona;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Alert;

class CoronaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $corona;
    public function __construct(Corona $corona)
    {
        $this->corona = $corona;
    }
    public function index()
    {
        /* $day = Carbon::now()->format('yy-m-d');
        $corona = $this->corona::with('user')->where([
            ['user_id','=', auth::user()->id],
            ['created','=', $day]
        ])->latest()->get(); */
        return view('corona.index');
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
        $user = DB::select('select user_id from coronas where user_id ='.Auth()->user()->id.' and created="'.$day.'"');
        if(!empty($user))
        {            
            return redirect()->back()->with('error', __('msg.formError'));
        }
        else{
            $this->corona->create($request->all()+ ['created' => $day,'user_id'=>$request->user()->id,'empid'=>$request->user()->empid ]);
            return redirect()->route('disclosure.show',auth()->user()->id);
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
        $day = Carbon::now()->format('yy-m-d');
        $corona = $this->corona::with('user')->where([
            ['user_id','=', $id]
            ,['created','=', $day]
            ,['approved','=', 0]
        ])->latest()->get();
        return view('corona.order', compact('corona'));
    }
    
    public function display()
    {
        $day = Carbon::now()->format('yy-m-d');
        $corona = $this->corona::with('user')->where([
            ['created','=', $day]
            ,['approved','=', 1]
            ,['mainapproved','=', 0]
        ])->get();
        return view('corona.display',compact('corona'));
        /* return $corona; */
    }
    public function allData()
    {
        $day = Carbon::now()->format('yy-m-d');
        $corona = $this->corona::with('user')->latest('created')->get();
        /* ->orderBy('created','desc') */
        /* ->where([['created','=', $day]]) */
        return view('corona.allData',compact('corona'));
        /* return $corona; */
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $this->corona->find($id)->update($request->all()+['mainapproved' => 1]);
        return back();
        /* return back()->with('success',trans('alerts.updateord')); */
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
        $this->corona->find($id)->update($request->all()+['approved' => 1]);
        return back()->with('success',__('msg.orderCorona'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
