<?php

namespace App\Http\Middleware\Auction;

use App\Models\Auction\auctionemps;
use Closure;

class AuctionPermission
{
    protected $auctionemps;

    public function __construct(auctionemps $auctionemps)
    {
        $this->auctionemps = $auctionemps;
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
        $emp = $this->auctionemps::where([
            ['empid', '=', Auth()->user()->empid],
            ['status', '=', 1]
            ])->get();
        if (count($emp) == 0) {
            return redirect('home');
        }else{
            return $next($request);
        }
    }
}
