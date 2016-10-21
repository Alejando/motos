<?php

namespace DwSetpoint\Http\Controllers;
use Illuminate\Http\Request;
use DwSetpoint\Http\Requests;
class HomeCtrl extends Controller {
    public function index(){
        $products = \DwSetpoint\Models\Product::where('id','!=','')->paginate();
        return view('public.pages.home',[
            'showOffert' => true,
            'showBannerBottom' => true,
            'products' => $products
        ]);
    }
}
