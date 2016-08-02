<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController {
    public function index(){
        return view("admin.pages.home");
    }
}
