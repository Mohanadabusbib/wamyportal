<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\invtyManufacturers;
use Illuminate\Http\Request;

class InvtyManufacturersController extends Controller
{
    protected $manufacturers;

    public function  __construct(invtyManufacturers $manufacturers)
    {
        $this->manufacturers = $manufacturers;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = $this->manufacturers::all();
        $manufacturerId = $this->manufacturers::pluck('id')->last()+1;
        return view('Inventory.manufacturers',compact('manufacturers','manufacturerId'));
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
        $manufacturers = $this->manufacturers::where('name',$request->name)->get();
        if(count($manufacturers) > 0){
            return back()->with('error','The Manufacturer already exists');
        }else{
            $this->manufacturers::create([
                'name' => $request->name,
                'userEntry' => Auth()->user()->empid
            ]);
    
            return back()->with('success','Manufacturer added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\invtyManufacturers  $invtyManufacturers
     * @return \Illuminate\Http\Response
     */
    public function show(invtyManufacturers $invtyManufacturers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\invtyManufacturers  $invtyManufacturers
     * @return \Illuminate\Http\Response
     */
    public function edit(invtyManufacturers $invtyManufacturers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\invtyManufacturers  $invtyManufacturers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invtyManufacturers $invtyManufacturers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\invtyManufacturers  $invtyManufacturers
     * @return \Illuminate\Http\Response
     */
    public function destroy(invtyManufacturers $invtyManufacturers)
    {
        //
    }
}
