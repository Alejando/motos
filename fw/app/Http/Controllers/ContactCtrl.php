<?php

namespace DwSetpoint\Http\Controllers;
use Illuminate\Http\Request;
use DwSetpoint\Http\Requests;
class ContactCtrl extends Controller {
    public function index(){
        return view('public.pages.contact',[
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }
}
