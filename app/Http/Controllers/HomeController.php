<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* $this->middleware('auth'); */
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Carbon::now()->day == 27) {
            return app('App\Http\Controllers\TransferData\TransferDataController')->storeBox();
        }
        
        $day = Carbon::now()->format('yy-m-d');
        $users = User::count();
        $visitors = Visitor::where(['vdate' => $day, 'approved'=>1])->count();

        /* return $; */
        return view('home',compact('users','visitors'));
    }
    public function badge(){
        $approval = Visitor::where(['user_id'=> Auth::user()->id]);
        view('layouts.main-sidebar','approval');
    }
}
