<?php

namespace App\Http\Middleware\Saving;

use Closure;
use App\Models\Saving;
use App\Models\Saving\Savings;
use RealRashid\SweetAlert\Facades\Alert;

class registry
{

    protected $savings;
    public function __construct(Savings $savings)
    {
        $this->savings = $savings;   
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $emp =  $this->savings::where('empid',Auth()->user()->empid)->get();
        if (count($emp) == 0) {
            Alert::error('','');
            return redirect('Home');
        }else{
            return $next($request);
        }
       /*  if ($emp = 11829) {
            return route('NewSavings');
        }else{
            return $next($request);
        } */
        
        /* return $emp; */
    }
}
