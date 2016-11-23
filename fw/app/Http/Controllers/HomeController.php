<?php

namespace DwSetpoint\Http\Controllers;

use DwSetpoint\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        die("asdfasd");
        return view('home');
    }
    public function holamundo($mjs){
       return $size = \DwSetpoint\Models\Size::getAll();
       
        
    }
}
