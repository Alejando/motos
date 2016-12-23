<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DwSetpoint\Http\Controllers;

use Illuminate\Support\Facades\Input;
/**
 * Description of CartController
 *
 * @author jdiaz
 */
class CartController  extends Controller {
    public function listItems(){
        return view('public.pages.cartListItems', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }
    public function shippingForm() {
        return view('public.pages.shipping', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);     
    }
    public function registrationForm () {
        return view('public.pages.client-registration-form', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }
    
    public function confirmCheckout() {
        return view('public.pages.checkout', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }
    
    public function checkout() {
        
        $order = new \DwSetpoint\Models\Order();
        $order->address_id = Input::get('addrees');
//        $order->save();
//        $order->setItems(Input::get('items'));
//        $order->setPSP(Input::get('psp'));
//        $order->save();
    }
}
