<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController {
    public function index(){
//        return view("public.pages.profile", ['aunctions' => $aucntions]);
    }
    public function profile(){
        return view('public.pages.profiles',[
            'user'=> \Auth::user()
        ]);
    }
}
