<?php

namespace DwSetpoint\Http\Controllers;
use Illuminate\Http\Request;
use DwSetpoint\Http\Requests;
class HomeCtrl extends Controller {
    public function index(){
        return view('public.pages.home',[
            'showOffert' => true,
            'showBannerBottom' => true
        ]);
    }
}
