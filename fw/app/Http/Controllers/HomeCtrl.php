<?php

namespace DwSetpoint\Http\Controllers;
use Illuminate\Http\Request;
use DwSetpoint\Http\Requests;
class HomeCtrl extends Controller {
    public function index(){
        $products = \DwSetpoint\Models\Product::where('id','!=','')->orderByRaw("RAND()")->paginate(8);
        return view('public.pages.home',[
            'showOffert' => true,
            'showBannerBottom' => true,
            'products' => $products
        ]);
    }

    public function newProducts(){
        $products = \DwSetpoint\Models\Product::orderBy('id', 'desc')->take(8)->get();
        return view('public.pages.newProducts',[
            'showOffert' => true,
            'showBannerBottom' => true,
            'products' => $products
        ]);
    }

    public function discountedProducts(){
        $products = \DwSetpoint\Models\Product::where('discount_percentage', '>', 0)->paginate(8);
        return view('public.pages.discountedProducts',[
            'showOffert' => true,
            'showBannerBottom' => true,
            'products' => $products
        ]);
    }

    public function aboutUs(){
        //$contect = \DwSetpoint\Models\Contect::find(1);
        return view('public.pages.aboutUs',[
            'showOffert' => false,
            'showBannerBottom' => false
            //'contect' => $contect
        ]);
    }
}
