<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\inventory;
use App\Models\Inventory\invtyStock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvtyStockController extends Controller
{
    protected $stocks;
    protected $inventory;
    public function __construct(invtyStock $stocks,inventory $inventory)
    {
        $this->stocks = $stocks;
        $this->inventory = $inventory;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = $this->stocks::all();
        
        return view('Inventory.stock',compact('stocks'));
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

    public function search($id)
    {
        if (is_null($id)) {
            $stocks = $this->stocks::all();
            return json_encode($stocks);
        }else{
            $stocks = $this->stocks::where('StockTyp',$id)->get();
            return json_encode($stocks);
        }
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stock = $this->stocks::where('StockId',$request->StockId)->get();
        if (count($stock) > 0 ){
            return back()->with('error','Something went wrong');
        }else{
            $this->stocks::create([
                'StockId' => $request->StockId,
                'StockNameAr' => $request->StockNameAr,
                'StockNameEn' => $request->StockNameEn,
                'StockTyp' => $request->StockTyp,
                'userEntry' => Auth()->user()->empid
            ]);
            return back()->with('success','Store added successfully');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\invtyStock  $invtyStock
     * @return \Illuminate\Http\Response
     */
    public function show(invtyStock $invtyStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\invtyStock  $invtyStock
     * @return \Illuminate\Http\Response
     */
    public function edit(invtyStock $invtyStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\invtyStock  $invtyStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $day = Carbon::now()->format('Y-m-d h:m:s');
        if ($id == 1) {
            $this->stocks::where('StockId',$request->stockIdEdit)->update([
                'StockNameAr' =>$request->stockNameArEdit ,
                'StockNameEn' =>$request->stockNameEnEdit,
                'userEntry' => Auth()->user()->empid,
                'updated_at' => $day
            ]);
            return back()->with('success','Store Id '.$request->stockIdEdit.' updated successfully');
        }else{
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\invtyStock  $invtyStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        /* return $request; */
        

        if ($id == 2) {
            $inventory = $this->inventory::where('StockIN',$request->stockIdDel)->whereOr('StockOUT',$request->stockIdDel)->get();
            if (count($inventory) > 0) {
                /* return "No Delete"; */
                return back()->with('error', 'Sorry, you cant delete this store because it is used in the inventory');
            }else{
                return "Delete";
            }
            /* $stock = $this->stocks::findOrFail($request->stockIdEdit);
            $stock->delete();
            return back()->with('success','Store Id '.$request->stockIdEdit.' deleted successfully'); */
        }else{
            return back()->with('error', 'Something went wrong');
        }
    }
}
