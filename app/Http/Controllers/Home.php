<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Home extends BaseController {
    public function index(){
        return view("public.pages.home");
    }
}
