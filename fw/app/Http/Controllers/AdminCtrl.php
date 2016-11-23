<?php

namespace DwSetpoint\Http\Controllers;
use Illuminate\Http\Request;
use DwSetpoint\Http\Requests;
use Faker\Factory as Faker;
class AdminCtrl extends Controller {
    public function index(){
        return view('admin.pages.home');
    }
}
