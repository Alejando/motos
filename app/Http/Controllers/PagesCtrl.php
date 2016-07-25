<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class PagesCtrl extends BaseController {
    public function admin($view){
        return view("admin.pages.$view");
    }
}
