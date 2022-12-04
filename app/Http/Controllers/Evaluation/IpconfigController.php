<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ipconfig;
use Illuminate\Support\Facades\DB;
use Alert;

class IpconfigController extends Controller
{
    protected $ipconfig;

    public function __construct(ipconfig $ipconfig)
    {
        $this->ipconfig = $ipconfig;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ipconfig = DB::select('SELECT i.id,ip,i.empid,u.name,active FROM ipconfigs AS i LEFT JOIN users AS u ON u.empid = i.empid');
        return view('evaluation.ipconfig',compact('ipconfig'));
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
        /* return $request->all(); */
        $ipconfig = $this->ipconfig::where('ip',$request->ipAdd)->get();
        if (count($ipconfig)) {
            Alert::error($request->ipAdd,"هذا العنوان مسجل من قبل"); 
            return back();
        } else {
            $this->ipconfig::create([
                'ip' => $request->ipAdd,
                'empid' => Auth()->user()->empid,
            ]);
            Alert::success($request->ipAdd,"تم إضافة العنوان"); 
            return back();
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
        //
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
        /* return $request->all(); */
        if ($id == 1) {
            $ipconfig = $this->ipconfig::where('ip',$request->ipAdd)->get();
            if (count($ipconfig)) {
                Alert::error($request->ipAdd,"هذا العنوان مسجل من قبل"); 
                return back();
            } else {
                $this->ipconfig::where('id', $request->id)->update([
                    'ip' => $request->ipAdd,
                ]);
                Alert::success($request->ipAdd,"تم تعديل العنوان"); 
                return back();
            }
        } else {
            /* return $request->all(); */
            if ($request->active == 0) {
                $this->ipconfig::where('id', $request->id)->update([
                    'active' => 1,
                ]);
                Alert::success($request->ipAdd,"تم تفعيل العنوان"); 
                return back();
            } else {
                $this->ipconfig::where('id', $request->id)->update([
                    'active' => 0,
                ]);
                Alert::success($request->ipAdd,"تم إلغاء تفعيل العنوان"); 
                return back();
            }
            
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        /* return $request->all(); */
        $ipconfig = $this->ipconfig::findOrFail($request->id);
        $ipconfig->delete();
        Alert::error($request->ipAdd,"تم حذف العنوان");
        return back();
        
    }
}
