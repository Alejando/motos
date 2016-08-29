<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Home extends BaseController {
    public function index() {        
//        \GlimGlam\Models\Auction::getBuyables(Auth::user());
        $aucntions = \GlimGlam\Models\Auction::getAll();
        $sliderAuctions = \GlimGlam\Models\Auction::getUpcoming()->take(5)->get();
        return view("public.pages.home", [
            'aunctions' => $aucntions,
            'sliderAuctions' => $sliderAuctions,
//            'lastStarted' => $lastStarted
        ]);
    }
}
