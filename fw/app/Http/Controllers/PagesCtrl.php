<?php

namespace DwSetpoint\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class PagesCtrl extends BaseController {
    public function admin($view){
        return view("admin.blocks.$view");
    }
}
