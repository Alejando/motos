<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
class TestJaredCtrl extends BaseController {
    public function getIndex(){      
        return "index";
    }
    public function getTest1(){
        return view("detalle",[
            'nombre' => '<b>No</b>mbre',
            'subastas'=> \GlimGlam\Models\Auction::getAll()
        ]);
    }
}
