<?php

namespace App\Http\Controllers\Auction;

use App\Http\Controllers\Controller;
use App\Models\Auction\auctionemps;
use App\Models\Auction\auctions;
use App\Models\Auction\auctiontrns;
use App\Models\TransferData\empdata;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AuctionController extends Controller
{
    protected $auctions;
    protected $auctiontrns;
    public function __construct(auctions $auctions,auctiontrns $auctiontrns)
    {
        $this->middleware('auction.prmission',['except'=>['show']]);
        $this->auctions = $auctions;
        $this->auctiontrns = $auctiontrns;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            /* $auctions = $this->auctions->Images()->get(); */
            
            
            $auctions = $this->auctions->with(['Images'])->orderBy('ord')->get();
            $status = auctionemps::where('empid',Auth()->user()->empid)->pluck('status')->first();
            $error = "";
            date_default_timezone_set('Asia/Riyadh');
            $dateNow = Carbon::now();

            return view('auction.auction',compact('auctions','error','status','dateNow'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
        
        
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auction.create');
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newId = $request->itemOrd + 15 ;
        $this->auctions::where('id',$request->itemId)->update(['ord' => $newId]);
        return redirect()->route('auctions.index');
        /* $newOrderby = $request->id + 15;
        return $newOrderby; */
        /* $this->auctions::where('id',$request->id)->update([
            'ord' => 1
        ]);
        return redirect()->route('registrAuction.create'); */
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth()->user()->empid == 11829 || Auth()->user()->empid == 11175 || Auth()->user()->empid == 11693 || Auth()->user()->empid == 11939 || Auth()->user()->empid == 11803) {
            $auctions = $this->auctions->with(['Images'])->orderBy('ord')->get();
            return view('auction.display',compact('auctions','id'));
        } else {
            return redirect()->route('home');
        }
        
        /* $auctions = $this->auctions::all(); */
        /*$auctions = DB::select('SELECT a.id,type,numberboard,color,model,image,price,lastprice,auctionUser,u.name 
            FROM auctions a LEFT JOIN users u ON a.auctionUser= u.empid ');*/
        
        
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
    public function update(Request $request)
    {
        
        try {
            date_default_timezone_set('Asia/Riyadh');
            $dateNow = Carbon::now();
            
            
            if ($dateNow >= $request->fDate  ) {
                
                $car = $this->auctions::where('id',$request->id)->pluck('type')->first();
                $error = 'للأسف إنتهى الزمن للسيارة   '.$car;
                $auctions = $this->auctions::all();
                return view('auction.auction',compact('error','auctions'));
            } elseif ($dateNow < $request->fDate) {
                $price = $this->auctions::where('id',$request->id)->pluck('price')->first();
                $lastprice = $this->auctions::where('id',$request->id)->pluck('lastprice')->first();
                if ($price > $lastprice) {
                    if ($request->amount > $price) {
                        
                        $this->auctions::where('id',$request->id)->update(['lastprice' => $request->amount,'auctionUser' => Auth()->user()->empid]);
                        $this->auctiontrns::create([
                            'auction_id' =>$request->id,
                            'price' => $request->amount,
                            'userEntry'=>Auth()->user()->empid
                        ]);
                        $auctions = $this->auctions::all();
                        $error = "";
                        return redirect()->route('auctions.index');
                    } elseif ($request->amount <= $price) {
                        $error = "عفواً المبلغ المدخل أصغر او يساوي السعر المحدد";
                        $auctions = $this->auctions::all();
                        return view('auction.auction',compact('error','auctions'));    
                    }
                } elseif ($price == $lastprice) {
                    return "Error Message" ;
                } elseif ($price < $lastprice) {
                    if($request->amount <= $lastprice){
                        $error = "عفواً المبلغ المدخل أصغر او يساوي السعر المحدد";
                        $auctions = $this->auctions::all();
                        return view('auction.auction',compact('error','auctions'));
                    }else{
                        $this->auctions::where('id',$request->id)->update(['lastprice' => $request->amount,'auctionUser' => Auth()->user()->empid]);
                        $this->auctiontrns::create([
                            'auction_id' =>$request->id,
                            'price' => $request->amount,
                            'userEntry'=>Auth()->user()->empid
                        ]);
                        $auctions = $this->auctions::all();
                        $error = "";
                        return redirect()->route('auctions.index');
                    }
                }
            } 
            
           /*  */
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
        
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

    public function fReport()
    {
        $cars = DB::select('SELECT type,numberboard,price,lastprice,lastprice-price AS Fprice,auctionUser,u.name
        FROM auctions a LEFT JOIN users u ON a.auctionUser = u.empid ORDER by a.id');

        $sumPrice = $this->auctions::sum('price');
        /*$sumPrice = DB::select('SELECT sum(price) FROM auctions');*/
        $lastprice = $this->auctions::sum('lastprice');
        $total = $lastprice - $sumPrice;
        /*return $sumPrice;*/
        return  view('auction.fReport',compact('cars','sumPrice','lastprice','total'));
    }
}
