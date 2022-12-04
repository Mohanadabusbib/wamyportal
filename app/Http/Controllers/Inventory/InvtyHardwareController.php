<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\invtyHardware;
use Illuminate\Http\Request;

class InvtyHardwareController extends Controller
{
    protected $hardwares;

    public function __construct(invtyHardware $hardwares)
    {
        $this->hardwares = $hardwares;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $hardwares = $this->hardwares::all();
        $hardwareId = $this->hardwares::pluck('id')->last()+1;
        
        return view('Inventory.hardware',compact('hardwares','hardwareId'));
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
        $hardware = $this->hardwares::where('name',$request->name)->get();
        if($hardware){
            return back()->with('error','The Hardware already exists');
        }else{
            $this->hardwares::create([
                'name' => $request->name,
                'userEntry' => Auth()->user()->empid
            ]);
    
            return back()->with('success','Hardware added successfully');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\invtyHardware  $invtyHardware
     * @return \Illuminate\Http\Response
     */
    public function show(invtyHardware $invtyHardware)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\invtyHardware  $invtyHardware
     * @return \Illuminate\Http\Response
     */
    public function edit(invtyHardware $invtyHardware)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\invtyHardware  $invtyHardware
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invtyHardware $invtyHardware)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\invtyHardware  $invtyHardware
     * @return \Illuminate\Http\Response
     */
    public function destroy(invtyHardware $invtyHardware)
    {
        //
    }
}
