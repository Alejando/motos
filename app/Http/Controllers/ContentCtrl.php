<?php

namespace DwSetpoint\Http\Controllers;

use DwSetpoint\Http\Requests;
use Illuminate\Http\Request;

class ContentCtrl extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return "¡Hola mundo!";
    }

}
