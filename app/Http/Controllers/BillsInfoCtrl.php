<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class BillsInfoCtrl extends BaseController {
    public function getInfo(){
        $user = \Auth::user();
        $info = $user->billsInfo;
        if($info){
            return $info;
        }
        return array('error'=>true);
    }
    public function setInfo(){
        $user = \Auth::user();
        $info = $user->billsInfo;

        if(!$info){
            $info = new BillsInfo();
        }
        $info->fill(Input::get());
        $info->save();
        return array('error'=>true);
    }
}