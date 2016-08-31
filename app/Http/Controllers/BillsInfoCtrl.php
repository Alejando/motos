<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use \GlimGlam\Models\BillsInfo;
class BillsInfoCtrl extends BaseController {
    public function getInfo(){
        $user = \Auth::user();
        $info = $user->billsInfo;
        if($info){
            return $info;
        }
        return ['success' => true];
    }
    public function setInfo(){
        $user = \Auth::user();
        $info = $user->billsInfo;

        if(!$info){
            
            $info = new BillsInfo();
        }
        $info->fill(Input::get());
        $info->user_id = $user->id;
        $info->save();
        return ['success' => true];
    }
}