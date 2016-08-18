<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class AuctionCotroller extends BaseController {
    public function enrollmentPayment($code) {        
        return view('public.pages.enrollment-payment',[
            'code' => $code
        ]);
    }
}
