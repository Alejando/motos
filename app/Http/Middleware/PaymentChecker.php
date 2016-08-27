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
    public function handle($request, Closure $next) {
        $code = $request->route()->parameters()['code'];
        $payment = false;
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $user = \Auth::user();
        
        $payment = $auction->isEnrolled($user);
        
        if(!$payment) {
            return redirect(asset('subastas/asiento-checkout/'.$code));
        }
        return $next($request);
        
    }
}
