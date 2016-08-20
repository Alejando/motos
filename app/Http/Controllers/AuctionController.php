<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
class AuctionController extends BaseController {
    public function enrollmentPayment($code) {        
        if(Auth::User()){
            session(['login-redirect', url(route('auction.enrollment-form',['code'=>$code]))]);
            return view('public.pages.enrollment-payment',[
                'auction' => \GlimGlam\Models\Auction::getByCode($code),
                'user' => Auth::User()
            ]);
        }
        return redirect(url('/login'));
    }
    public function paymentApprovated() {        
        $code = \Session::get('payment_auction_code');
        \Session::forget('payment_auction_code');
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $auction = \GlimGlam\Models\Auction::getRandom();
        return view ('public.pages.auction-approvated', [
            'auction' => $auction,
            'user' => Auth::User()
            
        ]);
    }
    public function paymentFailed() {
        return view ('auction-payment-failed');
    }
    public function room($code) {
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        return view ('public.pages.room', [
            'auction' => $auction
        ]);
    }
}
