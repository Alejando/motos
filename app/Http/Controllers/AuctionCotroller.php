<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class AuctionCotroller extends BaseController {
    public function enrollmentPayment() {        
        return view('public.pages.enrollment-payment');
    }
}
