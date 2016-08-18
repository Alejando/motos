<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
class AuctionCotroller extends BaseController {
    public function enrollmentPayment($code) {        
        return view('public.pages.enrollment-payment',[
            'auction' => \GlimGlam\Models\Auction::getByCode($code),
            'user' => Auth::User()
        ]);
    }
}
