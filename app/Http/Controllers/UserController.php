<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController {
    public function index(){
//        return view("public.pages.profile", ['aunctions' => $aucntions]);
    }
    public function profile(){
        $conversion = \Session::get('googCon');
        //echo "Se obtuvo conversion <br>";
        \Session::forget('googCon');
        //dd(\Session::get('conversion'));
        //echo "Se olvido conversion <br>";
        $params = [
            'user'=> \Auth::user(),
            'conversion'=>$conversion
        ];
        unset($conversion);
        return view('public.pages.profiles', $params);
    }
}
