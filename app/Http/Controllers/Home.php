<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Home extends BaseController {
    public function index() {        
        $fistTime = \Cookie::get('first-time');
        \Cookie::queue('first-time', 'no', 99999999);
        $fistTime = \Cookie::get('first-time');
        if($fistTime == null) {
            $bFirstTime = true;
            \Cookie::forever('first-time', 'no');
        } else {
            $bFirstTime = false;
        }
//        \GlimGlam\Models\Auction::getBuyables(Auth::user());
        $aucntions = \GlimGlam\Models\Auction::getAll();
        $sliderAuctions = \GlimGlam\Models\Auction::getUpcoming()->take(5)->get();
        return view("public.pages.home", [
            'aunctions' => $aucntions,
            'sliderAuctions' => $sliderAuctions,
            'bFirstTime' => $bFirstTime
//            'lastStarted' => $lastStarted
        ]);
    }
}
