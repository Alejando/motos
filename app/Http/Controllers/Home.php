<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Home extends BaseController {
    public function index(){
        $aucntions = \GlimGlam\Models\Auction::getAll();
        return view("public.pages.home", ['aunctions' => $aucntions]);
    }
}
