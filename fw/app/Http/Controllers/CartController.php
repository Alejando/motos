<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DwSetpoint\Http\Controllers;

use Illuminate\Support\Facades\Input;
use DwSetpoint\Models\Stock;
use DwSetpoint\Models\Item;
use \DwSetpoint\Models\PSP;
/**
 * Description of CartController
 *
 * @author jdiaz
 */
class CartController  extends Controller {
    public function listItems(){
        return view('public.pages.cart.listItems', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }
    public function shippingForm() {
        return view('public.pages.cart.user-info', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);     
    }
    public function registrationForm () {
        $user = auth()->user();
        if($user){
            return redirect(route('cart.shiping'));
        }
        return view('public.pages.client-registration-form', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }
    
    public function confirmCheckout() {
        return view('public.pages.checkout', [
            'showOffert' => false,
            'showBannerBottom' => false,
            'checkout' => Input::get('checkout')
        ]);
    }
    public function success() {
        try { 
            $order = \DwSetpoint\Models\Order::getById(Input::get('order'));
            $psp = \DwSetpoint\Models\PSP::createByOrder($order);
            $psp->getPSPResult(Input::all());
            $result = $psp->getState();
            if($result) {
                $order->sendMail(\Auth::user());                
                return view('public.pages.cart.success');
            } else {
                return redirect(route('cart.confirmCheckout',[
                    'checkout' => 'fail'
                ]));
            }
        }catch(\Exception $ex) {
            throw $ex;
             return redirect(route('cart.confirmCheckout',['checkout' => 'fail']));
        }
    }
    public function checkout() {
        $user = \Auth::user();
        $order = new \DwSetpoint\Models\Order();        
        $order->address_id = Input::get('shipping_address');
        $order->user_id = $user->id;
        $order->psp = Input::get('psp');
        $order->billing_information_id = input::get('billing_info');
        $itmes = Input::get('items');
        $order->save();
        foreach($itmes as $id => $quanty) {
            $stock = Stock::getById($id);
            $objItem = Item::create([
                'product_id' => $stock->product_id,
                'stock_id' => $stock->id,
                'price' => $stock->price,
                'quantity' => $quanty,
                'order_id' => $order->id
            ]);
        }
        $psp = PSP::createByOrder($order);
        switch($order->psp){
            case PSP::PAYPAL:
                $url = $psp->getCheckoutURL();
                return ['url' => $url];
            case PSP::CONEKTA:
                $psp->setToken(Input::get('conektaToken'));
                $psp->setUser($user);
                $result = $psp->checkout();
                return is_array($result)?
                        $result : 
                        ['url' => $psp->getSuccessUrl()];
        }
        die();
    }
}
