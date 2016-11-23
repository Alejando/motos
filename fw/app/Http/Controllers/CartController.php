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
class CartController  extends Controller {
    public function listItems(){
        return view('public.pages.cartListItems', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }
}
