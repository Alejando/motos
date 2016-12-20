<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DwSetpoint\Http\Controllers;

/**
 * Description of CartController
 *
 * @author jdiaz
 */
class UserController  extends Controller {
    public function profile(){
        return view('user.pages.profile', [
            'showOffert' => false,
            'showBannerBottom' => false
            // 'menuUser' => true

        ]);
    }

    public function getOrders(){
        return view('user.pages.orders', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }

    public function addresses(){
        return view('user.pages.addresses', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }
 	
 	// esta funcion es una prueba
    public function address(){
        return view('public.pages.address', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }
}

// $products = \DwSetpoint\Models\Product::where('discount_percentage', '>', 0)->paginate(8);
//         return view('public.pages.discountedProducts',[
//             'showOffert' => true,
//             'showBannerBottom' => true,
//             'products' => $products
//         ]);