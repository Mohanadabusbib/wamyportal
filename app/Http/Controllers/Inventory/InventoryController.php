<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\inventory;
use App\Models\Inventory\invtyHardware;
use App\Models\Inventory\invtyManufacturers;
use App\Models\Inventory\invtyStock;
use App\Models\Inventory\invtyTracks;
use App\Models\Inventory\invtyTypes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    protected $inventory;
    protected $invtyTracks;

    public function __construct(inventory $inventory,invtyTracks $invtyTracks)
    {
        $this->inventory = $inventory;
        $this->invtyTracks = $invtyTracks;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function truncateData()
     {
        /* In DB  */
        /* CREATE TABLE arch_inventories AS SELECT * FROM `inventories`
           CREATE TABLE arch_invtytracks AS SELECT * FROM `invtytracks` */
        
        inventory::truncate();
        invtyTracks::truncate();
        return "Tables truncated";
        /* $tableinventory = [inventories,invtyhardware,invtymanufacturers,invtystocks,invtytracks,invtytypes]; */
     }
    public function index()
    {
        $devices =
        DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
        i.ManfId,m.name As company,i.HdwModel,i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,
        CASE WHEN i.HdwType = 101 THEN (SELECT StockOUT FROM inventories WHERE HdwBarcode =i.HdwBarcode and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode)) END AS StockOUT,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockNameAr from invtystocks 
                    where StockId = (SELECT StockOUT FROM inventories WHERE HdwBarcode =i.HdwBarcode and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode))) END AS stockName,i.userEntry
        FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
        INNER JOIN invtytypes t ON i.HdwType = t.TypeId
        INNER JOIN invtyhardware h ON i.TohdwId = h.id
        INNER JOIN invtymanufacturers m  ON i.ManfId = m.id");
        return view('Inventory.Inventory',compact('devices'));
    }
    public function newSearch(Request $request, $id)
    {
        /* return $request; */
        $val = 0;
        switch ($id) {
            case 1:
                $devices =
                    DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
                    i.ManfId,m.name As company,i.HdwModel,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockOUT FROM inventories WHERE HdwBarcode =? and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = ?)) END AS StockOUT,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockNameAr from invtystocks 
                    where StockId = (SELECT StockOUT FROM inventories WHERE HdwBarcode =? and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = ?))) END AS stockName,
                    i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,i.userEntry
                    FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                    INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                    INNER JOIN invtyhardware h ON i.TohdwId = h.id
                    INNER JOIN invtymanufacturers m  ON i.ManfId = m.id WHERE i.HdwBarcode = ?",[$request->schBarcode,$request->schBarcode,$request->schBarcode,$request->schBarcode,$request->schBarcode]);
                break;
            case 2:
            case 3:
                if ($id == 3) {
                    $val = $request->schStockId;
                }else{$val = $request->schStoreId;}
                $devices =
                    DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
                    i.ManfId,m.name As company,i.HdwModel,i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockOUT FROM inventories WHERE HdwBarcode =i.HdwBarcode and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode)) END AS StockOUT,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockNameAr from invtystocks 
                    where StockId = (SELECT StockOUT FROM inventories WHERE HdwBarcode =i.HdwBarcode and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode))) END AS stockName,i.userEntry
                    FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                    INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                    INNER JOIN invtyhardware h ON i.TohdwId = h.id
                    INNER JOIN invtymanufacturers m  ON i.ManfId = m.id WHERE i.StockIN = ?",[$val]);
                break;
            case 4:
                $devices =
                    DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
                    i.ManfId,m.name As company,i.HdwModel,i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockOUT FROM inventories WHERE HdwBarcode =i.HdwBarcode and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode)) END AS StockOUT,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockNameAr from invtystocks 
                    where StockId = (SELECT StockOUT FROM inventories WHERE HdwBarcode =i.HdwBarcode and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode))) END AS stockName,i.userEntry
                    FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                    INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                    INNER JOIN invtyhardware h ON i.TohdwId = h.id
                    INNER JOIN invtymanufacturers m  ON i.ManfId = m.id WHERE i.TohdwId = ?",[$request->schHardwareId]);
                
                break;
            case 5:
                $devices =
                    DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
                    i.ManfId,m.name As company,i.HdwModel,i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockOUT FROM inventories WHERE HdwBarcode =i.HdwBarcode and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode)) END AS StockOUT,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockNameAr from invtystocks 
                    where StockId = (SELECT StockOUT FROM inventories WHERE HdwBarcode =i.HdwBarcode and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode))) END AS stockName,i.userEntry
                    FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                    INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                    INNER JOIN invtyhardware h ON i.TohdwId = h.id
                    INNER JOIN invtymanufacturers m  ON i.ManfId = m.id WHERE i.ManfId = ?",[$request->schManufacturerId]);
                
                break;
            case 6:
                $devices =
                    DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
                    i.ManfId,m.name As company,i.HdwModel,i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockOUT FROM inventories WHERE HdwBarcode =i.HdwBarcode and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode)) END AS StockOUT,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockNameAr from invtystocks 
                    where StockId = (SELECT StockOUT FROM inventories WHERE HdwBarcode =i.HdwBarcode and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode))) END AS stockName,i.userEntry
                    FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                    INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                    INNER JOIN invtyhardware h ON i.TohdwId = h.id
                    INNER JOIN invtymanufacturers m  ON i.ManfId = m.id WHERE i.HdwType = ?",[$request->schInvtyType]);
                
                break;
            
            default:
            $devices =
                DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
                i.ManfId,m.name As company,i.HdwModel,i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,
                CASE WHEN i.HdwType = 101 THEN (SELECT StockOUT FROM inventories WHERE HdwBarcode =i.HdwBarcode and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode)) END AS StockOUT,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockNameAr from invtystocks 
                    where StockId = (SELECT StockOUT FROM inventories WHERE HdwBarcode =i.HdwBarcode and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode))) END AS stockName,i.userEntry
                FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                INNER JOIN invtyhardware h ON i.TohdwId = h.id
                INNER JOIN invtymanufacturers m  ON i.ManfId = m.id");
                break;
        }
        return view('Inventory.Inventory',compact('devices'));
        
    }
    
    public function search($typ,$val)
    {
        switch ($typ) {
            case 1:
                $devices =
                    DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
                    i.ManfId,m.name As company,i.HdwModel,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockOUT FROM inventories WHERE HdwBarcode =? and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = ?)) END AS StockOUT,
                    CASE WHEN i.HdwType = 101 THEN (SELECT StockNameAr from invtystocks 
                    where StockId = (SELECT StockOUT FROM inventories WHERE HdwBarcode =? and InvId = 
                    (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = ?))) END AS stockName,
                    i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,i.userEntry
                    FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                    INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                    INNER JOIN invtyhardware h ON i.TohdwId = h.id
                    INNER JOIN invtymanufacturers m  ON i.ManfId = m.id WHERE i.HdwBarcode = ?",[$val,$val,$val,$val,$val]);
                break;
            case 2:
            case 3:
                $devices =
                    DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
                    i.ManfId,m.name As company,i.HdwModel,i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,i.userEntry
                    FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                    INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                    INNER JOIN invtyhardware h ON i.TohdwId = h.id
                    INNER JOIN invtymanufacturers m  ON i.ManfId = m.id WHERE i.StockIN = ?",[$val]);
                
                break;
            case 4:
                $devices =
                    DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
                    i.ManfId,m.name As company,i.HdwModel,i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,i.userEntry
                    FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                    INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                    INNER JOIN invtyhardware h ON i.TohdwId = h.id
                    INNER JOIN invtymanufacturers m  ON i.ManfId = m.id WHERE i.TohdwId = ?",[$val]);
                
                break;
            case 5:
                $devices =
                    DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
                    i.ManfId,m.name As company,i.HdwModel,i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,i.userEntry
                    FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                    INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                    INNER JOIN invtyhardware h ON i.TohdwId = h.id
                    INNER JOIN invtymanufacturers m  ON i.ManfId = m.id WHERE i.ManfId = ?",[$val]);
                
                break;
            case 6:
                $devices =
                    DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
                    i.ManfId,m.name As company,i.HdwModel,i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,i.userEntry
                    FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                    INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                    INNER JOIN invtyhardware h ON i.TohdwId = h.id
                    INNER JOIN invtymanufacturers m  ON i.ManfId = m.id WHERE i.HdwType = ?",[$val]);
                
                break;
            
            default:
            $devices =
                DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
                i.ManfId,m.name As company,i.HdwModel,i.HdwType, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,i.userEntry
                FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                INNER JOIN invtyhardware h ON i.TohdwId = h.id
                INNER JOIN invtymanufacturers m  ON i.ManfId = m.id");
                break;
            
        }
        return json_encode($devices);
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
        $device = $this->invtyTracks::where('HdwBarcode',$request->barcode)->get();
        
        $hdwId = $this->invtyTracks::pluck('HdwId')->last()+1;
        
        $hdwName = invtyHardware::where('id',$request->hardware_id)->pluck('name')->first();
        $day = Carbon::now()->format('Y-m-d h:m:s');
        $devices = $this->invtyTracks::all();
        if(count($device) == 0)
        {
            $this->invtyTracks::create([
                'HdwId' => $hdwId,
                'HdwBarcode' => $request->barcode,
                'HdwName' => $hdwName,
                'StockIN' => $request->stock_id,
                'TohdwId' => $request->hardware_id,
                'ManfId' => $request->manufacturer_id,
                'HdwModel' => $request->model,
                'HdwType' => $request->typeId,
                'userEntry' => Auth()->user()->empid,
                'created_at ' => $day
            ]);
    
            $this->inventory::create([
                'InvId' => $hdwId,
                'HdwBarcode' => $request->barcode,
                'TypeId' => $request->typeId,
                'StockIN' => $request->stock_id,
                'StockOUT' => 0,
                'Note' => $request->note,
                'userEntry' => Auth()->user()->empid,
                'created_at ' => $day
            ]);
            return view('Inventory.inventory',compact('devices'))->with('success','Barcode Number '. $request->barcode.' added successfully');

            /* return back()->with('success','Barcode Number '. $request->barcode.'  added successfully'); */
        }else{
            return view('Inventory.inventory',compact('devices'))->with('error','Barcode Number '. $request->barcode.' already exists');
            /* return back()->with('error','Barcode Number '. $request->barcode.' already exists'); */
        }
        /* return $request; */
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        /* HdwType */
            $hdwId = $this->invtyTracks::pluck('HdwId')->last()+1;
            $day = Carbon::now()->format('Y-m-d h:m:s');
            $store = invtyStock::where('StockId',$request->stock_id)->pluck('StockNameEn')->first();
            
            /* return $request; */ 
            $this->invtyTracks::where('HdwBarcode',$request->barcodeedit)->update([
                'StockIN' =>$request->stock_id,
                'HdwType' => $request->typeId,
                'userEntry' => Auth()->user()->empid,
                'updated_at'  => $day
            ]);
            $this->inventory::create([
                'InvId' => $hdwId,
                'HdwBarcode' => $request->barcodeedit,
                'TypeId' => $request->typeId,
                'StockIN' => $request->stock_id,
                'StockOUT' => $request->stockidedit,
                'Note' => $request->note,
                'userEntry' => Auth()->user()->empid,
                'created_at ' => $day
            ]);
            return redirect('Inventory')->with('success','The device has been successfully transferred to '.$store);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function printEmp(Request $request, $id)
    {
        if ($id == 1) {    
            $stockIn = $request->printEmp;
        } else {
            $stockIn = $id;
        }
        $day = Carbon::now()->format('Y-m-d');
        $emp = DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,i.TohdwId,h.name device,
        i.ManfId,m.name As company,i.HdwModel,
        CASE WHEN i.HdwType = 101 THEN (SELECT StockOUT FROM inventories WHERE HdwBarcode = i.HdwBarcode and InvId = 
        (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode)) END AS StockOUT,
        CASE WHEN i.HdwType = 101 THEN (SELECT StockNameAr from invtystocks 
        where StockId = (SELECT StockOUT FROM inventories WHERE HdwBarcode = i.HdwBarcode and InvId = 
        (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode))) END AS stockName,
        i.HdwType,t.TypeNameAr, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,i.userEntry
        FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
        INNER JOIN invtytypes t ON i.HdwType = t.TypeId
        INNER JOIN invtyhardware h ON i.TohdwId = h.id
        INNER JOIN invtymanufacturers m  ON i.ManfId = m.id WHERE i.StockIN = ?", [$stockIn]);

        $empInfo = DB::select('select * from empdatas where emp_no = ?', [$stockIn]);
        return view('Inventory.myCustody',compact('emp','empInfo','day'));
    }
    public function printAllEmp()
    {
        /* if ($id == 1) {    
            $stockIn = $request->printEmp;
        } else {
            $stockIn = $id;
        } */
        $day = Carbon::now()->format('Y-m-d');
        $invtytracks = DB::select("SELECT DISTINCT StockIN FROM invtytracks");
        return $invtytracks;
       /*  foreach ($invtytracks as $value) {
            $emp = DB::select("select i.id,i.HdwId,i.HdwBarcode,i.HdwName,i.StockIN,CONCAT( s.StockNameAr, ' --- ', s.StockNameEn ) stock ,s.StockNameAr,e.e_mail,e.hirchy_prnt_nm,e.hirch_nm
                ,i.TohdwId,h.name device,i.ManfId,m.name As company,i.HdwModel,CASE WHEN i.HdwType = 101 THEN (SELECT StockOUT FROM inventories WHERE HdwBarcode = i.HdwBarcode and InvId = (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode)) END AS StockOUT,
                CASE WHEN i.HdwType = 101 THEN (SELECT StockNameAr from invtystocks 
                where StockId = (SELECT StockOUT FROM inventories WHERE HdwBarcode = i.HdwBarcode and InvId = 
                (SELECT MAX(InvId)FROM `inventories` WHERE HdwBarcode = i.HdwBarcode))) END AS stockName,
                i.HdwType,t.TypeNameAr, CONCAT(t.TypeNameAr,' --- ',t.TypeNameEn) As hdType,i.userEntry
                FROM invtytracks i INNER JOIN invtystocks s ON i.StockIN = s.StockId
                INNER JOIN invtytypes t ON i.HdwType = t.TypeId
                INNER JOIN invtyhardware h ON i.TohdwId = h.id
                INNER JOIN invtymanufacturers m  ON i.ManfId = m.id
                INNER JOIN empdatas e  ON i.StockIN = e.emp_no WHERE i.StockIN = ?",[$value]);
            
        } */
        
        /* $empInfo = DB::select('select * from empdatas'); */
        
        return view('Inventory.AllCustody',compact('emp','day'));
    }
    public function show($id)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(inventory $inventory)
    {
        //
    }
}
