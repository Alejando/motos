<?php

namespace GlimGlam\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
class AuctionController extends BaseController {
    // <editor-fold defaultstate="collapsed" desc="enrollmentPayment">
    public function enrollmentPayment($code) {
//        
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        if(strpos(\URL::previous(),"mi-perfil") !== false) {//viene de perfil
            $url = route('my-profile',[])."#!favoritos/".$code.'/'.  str_slug($auction->title);
        } else {//viene de home
            $url = asset("/")."#!".$code.'/'.  str_slug($auction->title);;
        }
        
        
        session(['login-redirect', url(route('auction.enrollment-form',['code'=>$code]))]);
        return view('public.pages.enrollment-payment',[
            'auction' => \GlimGlam\Models\Auction::getByCode($code),
            'user' => Auth::User(),
            'urlBack' => $url
        ]);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="paymentApprovated">
    public function paymentApprovated() {        
        $code = \Session::get('payment_auction_code');
        Session::forget('payment_auction_code');
        return redirect(route('auction.room',[
            'code' => $code
        ]));
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="paymentFailed">
    public function paymentFailed($code) {
        $user = \Auth::user();
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        return view ('public.pages.auction-payment-failed', ['auction'=>$auction, 'user'=>$user]);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="room">
    public function room($code) {
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $related = \GlimGlam\Models\Auction::getRelated($code);
        $insertLeadFB = \Session::get('insertLeadFB');
        \Session::forget('insertLeadFB');
        return view ('public.pages.room', [
            'auction'=> $auction,
            'related'=> $related,
            'insertLeadFB' => $insertLeadFB
        ]);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="placeBid">
    public function placeBid(){
//        dd(\Auth::user()->id); 
        $user_id = \Auth::user()->id;
        $code = Input::get('code');
        $bid = Input::get('bid');
        $success = \GlimGlam\Models\Auction::placeBid($user_id, $code, $bid);
        return ['success' => $success];
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="paymentWin">
    public function paymentWin($code) {
//        die(".---");
        if(!Auth::check()){
            abort(404);
        }
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $me = \Auth::user();
        if($auction->winner!=$me->id){
            abort(404);
        }
        return view('public.pages.auction-checkout',[
            'auction' => $auction,
            'user' => Auth::user()
        ]);
        
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="confirmPayment">
    public function confirmPayment($code) {
        $user = \Auth::user();
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        return view('public.pages.auction-confirm-payment', ['auction'=>$auction, 'user'=>$user]);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getInfoBid">
    public function getInfoBid($code) {
        $user = \Auth::user();
        /* @var $auction \GlimGlam\Models\Auction */
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        return $auction->getInfoBid($user->id);
    }
    // </editor-fold>
}
