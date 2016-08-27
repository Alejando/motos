<?php

namespace GlimGlam\Http\Middleware;

use Closure;

class PaymentChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $redirectRoom = true) {
        $code = $request->route()->parameters()['code'];
        $payment = false;
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $user = \Auth::user();
        
        $payment = $auction->isEnrolled($user);
        
        if(!$payment) {
            return redirect(route('auction.enrollment-form',['code'=>$code]));
        }else{
            if($redirectRoom != 'false'){
                return redirect(route('auction.room',['code'=>$code]));
            }
        }
        return $next($request);
        
    }
}
