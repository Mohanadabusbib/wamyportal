<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeLang($lang)
    {
        if (in_array($lang, ['ar', 'en'])) {
            if (auth()->user()) {
                $user = auth()->user();
                $user->lang = $lang;
                $user->save();
            } else {
                if (session()->has('lang')) {
                    session()->forget('lang');
                }
                session()->put('lang', $lang);
            }
        } else {
            if (auth()->user()) {
                $user = auth()->user();
                $user->lang = 'ar';
                $user->save();
            } else {
                if (session()->has('lang')) {
                    session()->forget('lang');
                }
                session()->put('lang', 'ar');
            }
        }
        return back();
    }
    public function index($id)
    {
        $id = 'DASHBOARD.' . $id;
        if (view()->exists($id)) {
            return view($id);
        } else {
            return view('DASHBOARD.404');
        }
        /* return view($id); */
    }
    public function profile()
    {
        return view('profile.profile');
    }
    public function updprofile(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $filename = time().'-'.$request->avatar->getClientOriginalName();
            $request->avatar->storeAs('images',$filename,'public');
            User::find(Auth::user()->id)->update(['name'=> $request->name,'avatar' => $filename,'mobile' => $request->mobile]);
        }else{
            User::find(Auth::user()->id)->update(['name'=> $request->name,'mobile' => $request->mobile]);
        }
        return redirect()->back();
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
        //
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
        //
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
